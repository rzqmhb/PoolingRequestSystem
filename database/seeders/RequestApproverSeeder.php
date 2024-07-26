<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestApproverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $request_approvers = [
            [
                'approver1_id' => 2,
                'approver2_id' => 3,
                'approver1_status' => 'pending',
                'approver2_status' => 'pending',
            ],
            [
                'approver1_id' => 4,
                'approver2_id' => 3,
                'approver1_status' => 'pending',
                'approver2_status' => 'pending',
            ],
            [
                'approver1_id' => 2,
                'approver2_id' => 4,
                'approver1_status' => 'pending',
                'approver2_status' => 'pending',
            ],
            [
                'approver1_id' => 3,
                'approver2_id' => 2,
                'approver1_status' => 'pending',
                'approver2_status' => 'pending',
            ],
        ];

        foreach ($request_approvers as $request_approver) {
            DB::table('request_approvers')->insert([
                'approver1_id' => $request_approver['approver1_id'],
                'approver2_id' => $request_approver['approver2_id'],
                'approver1_status' => $request_approver['approver1_status'],
                'approver2_status' => $request_approver['approver2_status'],
            ]);
        }
    }
}
