<?php

namespace App\Http\Controllers;

use App\Models\ActivityLogs;
use Illuminate\Http\Request;
use DB;
use Auth;

class ActivityLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user = Auth::user();
        $logs = DB::select("SELECT users.user_name AS user, activity_time, activity
                            FROM activity_logs
                            JOIN users ON activity_logs.user_id = users.id
                            ORDER BY activity_logs.id DESC;");
        return view("log", compact("logs", "current_user"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $datetime = date('Y/m/d H:i:s', time());

        ActivityLogs::insertGetId([
            "user_id"=> $request->input("user_id"),
            "activity_time"=> $datetime,
            "activity"=> $request->input("activity"),
        ]);
    }
}
