<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requests = [
            [
                'vehicle_id' => '1',
                'approvers_id' => '1',
                'driver_name' => 'Agung',
                'fuel_estimation' => '35.7',
                'start_date' => '2024-07-26',
                'end_date' => '2024-08-20',
                'request_status' => 'pending',
            ],
            [
                'vehicle_id' => '4',
                'approvers_id' => '2',
                'driver_name' => 'Yoga',
                'fuel_estimation' => '54.2',
                'start_date' => '2024-07-30',
                'end_date' => '2024-09-12',
                'request_status' => 'pending',
            ],
            [
                'vehicle_id' => '7',
                'approvers_id' => '3',
                'driver_name' => 'Islah',
                'fuel_estimation' => '20.4',
                'start_date' => '2024-07-26',
                'end_date' => '2024-08-10',
                'request_status' => 'pending',
            ],
            [
                'vehicle_id' => '6',
                'approvers_id' => '4',
                'driver_name' => 'Fahmi',
                'fuel_estimation' => '32.2',
                'start_date' => '2024-07-28',
                'end_date' => '2024-08-22',
                'request_status' => 'pending',
            ],
            [
                'vehicle_id' => '2',
                'approvers_id' => '5',
                'driver_name' => 'Driver 1',
                'fuel_estimation' => '22.3',
                'start_date' => '2024-02-10',
                'end_date' => '2024-02-28',
                'request_status' => 'approved',
            ],
            [
                'vehicle_id' => '2',
                'approvers_id' => '6',
                'driver_name' => 'Driver 2',
                'fuel_estimation' => '30.2',
                'start_date' => '2024-03-01',
                'end_date' => '2024-03-26',
                'request_status' => 'approved',
            ],
            [
                'vehicle_id' => '2',
                'approvers_id' => '7',
                'driver_name' => 'Driver 3',
                'fuel_estimation' => '27.5',
                'start_date' => '2024-04-03',
                'end_date' => '2024-04-21',
                'request_status' => 'approved',
            ],
            [
                'vehicle_id' => '2',
                'approvers_id' => '8',
                'driver_name' => 'Driver 1',
                'fuel_estimation' => '34.2',
                'start_date' => '2024-05-01',
                'end_date' => '2024-05-30',
                'request_status' => 'approved',
            ],
            [
                'vehicle_id' => '2',
                'approvers_id' => '9',
                'driver_name' => 'Driver 2',
                'fuel_estimation' => '30.6',
                'start_date' => '2024-06-01',
                'end_date' => '2024-06-25',
                'request_status' => 'approved',
            ],
            [
                'vehicle_id' => '2',
                'approvers_id' => '10',
                'driver_name' => 'Driver 1',
                'fuel_estimation' => '42.4',
                'start_date' => '2024-06-26',
                'end_date' => '2024-07-29',
                'request_status' => 'approved',
            ],
        ];

        foreach ($requests as $request) {
            DB::table('requests')->insert([
                'vehicle_id' => $request['vehicle_id'],
                'approvers_id' => $request['approvers_id'],
                'driver_name' => $request['driver_name'],
                'fuel_estimation' => $request['fuel_estimation'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'request_status' => $request['request_status'],
            ]);
        }
    }
}
