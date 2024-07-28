<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ActivityLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logs = [
            [
                'user_id' => 1,
                'activity_time' => '2024-06-10 22:12:30',
                'activity' => 'created a new request',
            ],
            [
                'user_id' => 1,
                'activity_time' => '2024-06-15 14:22:49',
                'activity' => 'created a new request',
            ],
            [
                'user_id' => 1,
                'activity_time' => '2024-06-20 10:35:10',
                'activity' => 'created a new request',
            ],
            [
                'user_id' => 1,
                'activity_time' => '2024-06-30 15:32:45',
                'activity' => 'created a new request',
            ],
        ];

        foreach ($logs as $log) {
            DB::table('activity_logs')->insert([
                'user_id'=> $log['user_id'],
                'activity_time'=> $log['activity_time'],
                'activity'=> $log['activity'],
            ]);
        };
    }
}
