<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Request as RequestModel;
use App\Http\Controllers\RequestApproverController;
use App\Http\Controllers\ActivityLogsController;
use App\Exports\ReportTableExport;
use Maatwebsite\Excel\Facades\Excel;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user = Auth::user();
        $vehicles = Vehicle::get();
        $approvers = User::get()->whereNotIn('user_role', ['admin']);

        $data = DB::select("
        SELECT r.id, vehicles.vehicle_name AS vehicle, r.driver_name AS driver, r.fuel_estimation, approver1.user_name AS approver1_name, request_approvers.approver1_status, approver2.user_name AS approver2_name, request_approvers.approver2_status, r.start_date, r.end_date, r.request_status
        FROM requests AS r
        JOIN vehicles ON r.vehicle_id = vehicles.id
        JOIN request_approvers ON r.approvers_id = request_approvers.id
        JOIN users AS approver1 ON request_approvers.approver1_id = approver1.id
        JOIN users AS approver2 ON request_approvers.approver2_id = approver2.id
        ORDER BY `r`.`id` DESC;", []);

        return view("request_record", compact("data", "vehicles", "approvers", "current_user")); //request record
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle' => ['required'],
            'approver1' => ['required'],
            'approver2' => ['required'],
            'driver' => ['required'],
            'fuel_estimation' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        $requestApproverController = new RequestApproverController();

        $approvers_id = $requestApproverController->store(new Request([
            'approver1_id' => $data['approver1'],
            'approver2_id' => $data['approver2'],
        ]));

        RequestModel::insert([
            'vehicle_id' => $data['vehicle'],
            'approvers_id' => $approvers_id,
            'driver_name' => $data['driver'],
            'fuel_estimation' => $data['fuel_estimation'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        $user = Auth::user();
        $vehicle = Vehicle::find($data['vehicle']);
        $approver1 = User::find($data['approver1']);
        $approver2 = User::find($data['approver2']);

        $activityLogsController = new ActivityLogsController();
        $activityLogsController->store(new Request([
            'user_id' => $user->id,
            'activity' => "Created a new request to use ".strval($vehicle->vehicle_name)." from ".$data['start_date']." to ".$data['end_date']." with fuel usage estimation of ".$data['fuel_estimation']."L. With ".strval($approver1->user_name)." and ".strval($approver2->user_name)." as approvers.",
        ]));

        return redirect()->route('requests')->with('success','Created a new request successfully.');
    }

    public function approverIndex()
    {
        $current_user = Auth::user();

        $data = DB::select("
        SELECT r.id, r.approvers_id, vehicles.vehicle_name AS vehicle, r.driver_name AS driver, r.fuel_estimation, r.start_date, r.end_date, r.request_status, request_approvers.approver1_status, request_approvers.approver2_status, request_approvers.approver1_id, request_approvers.approver2_id
        FROM requests AS r
        JOIN vehicles ON r.vehicle_id = vehicles.id
        JOIN request_approvers ON r.approvers_id = request_approvers.id
        WHERE request_approvers.approver1_id = ? OR request_approvers.approver2_id = ?
        ORDER BY `r`.`id` DESC;", [$current_user->id, $current_user->id]);

        return view("approver_dashboard", compact("data", "current_user"));
    }

    public function export(Request $request)
    {
        $data = DB::select("
        SELECT r.id, vehicles.vehicle_name AS vehicle, r.driver_name AS driver, r.fuel_estimation, r.start_date, r.end_date, r.request_status
        FROM requests AS r
        JOIN vehicles ON r.vehicle_id = vehicles.id
        WHERE r.request_status = 'approved' OR r.request_status = 'declined'
        ORDER BY `r`.`id` DESC;");

        $data = array_map(function ($item) {
            return (array) $item;
        }, $data);

        date_default_timezone_set('Asia/Jakarta');
        $datetime = date('Y-m-d H:i:s', time());

        return Excel::download(new ReportTableExport($data), 'Report_'.strval($datetime).'.xlsx');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = RequestModel::find($id);
        $data = $request->validate([
            'approver_id' => ['required'],
            'approvers_id' => ['required'],
            'decision' => ['required'],
        ]);

        $requestApproverController = new RequestApproverController();
        $requestApproverController->update(new Request([
            'approver_id' => $data['approver_id'],
            'decision' => $data['decision'],
        ]), $data['approvers_id']);

        if ($data['decision'] == 'accepted') {
            switch ($requestData->request_status) {
                case 'single approval':
                    $requestData->update(['request_status'=> 'approved']);
                    break;
                default:
                    $requestData->update(['request_status'=> 'single approval']);
                    break;
            }
        } else {
            $requestData->update(['request_status'=> 'declined']);
        }

        $vehicle = Vehicle::find($requestData->vehicle_id);

        $activityLogsController = new ActivityLogsController();
        $activityLogsController->store(new Request([
            'user_id' => $data['approver_id'],
            'activity' => $data['decision']." a request to use".strval($vehicle->vehicle_name)." from ".strval($requestData->start_date)." to ".strval($requestData->end_date)." with fuel usage estimation of ".strval($requestData->fuel_estimation)."L. With ".strval($requestData->driver_name)." as the driver.",
        ]));

        return redirect()->route('approver.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
