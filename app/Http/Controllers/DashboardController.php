<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use stdClass;

class DashboardController extends Controller
{
    public function index() {
        $current_user = Auth::user();
        $requests_count = DB::select("SELECT COUNT(id) AS sum, request_status AS status
                                FROM requests
                                GROUP BY request_status;");
        $vehicles_count = DB::select("SELECT COUNT(id) AS sum, vehicle_type AS type
                                FROM vehicles
                                GROUP BY type");

        $vehicles_id = DB::select("SELECT id FROM vehicles ORDER BY id ASC");
        $vehicles_data = new stdClass();

        foreach ($vehicles_id as $vehicle) {
            $id = $vehicle->id;
            $data = DB::select("SELECT vehicles.vehicle_name AS vehicle, fuel_estimation, DATEDIFF(end_date, start_date) AS usage_days, CONCAT(start_date, ' until ', end_date) AS usage_date
                                FROM requests
                                JOIN vehicles ON requests.vehicle_id = vehicles.id
                                WHERE vehicle_id = ? AND request_status = 'approved'
                                ORDER BY requests.id ASC;", [$id]);

            $vehicles_data->$id = $data;
        }

        return view('dashboard', compact('current_user', 'requests_count', 'vehicles_count', 'vehicles_data'));
    }
}
