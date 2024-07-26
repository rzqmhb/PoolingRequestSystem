<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user_name' => 'Sujatmiko',
                'user_email' => 'sujatmiko@domain.com',
                'user_password' => 'sujatmiko111',
                'user_role' => 'admin',
            ],
            [
                'user_name' => 'Budi',
                'user_email' => 'budi@domain.com',
                'user_password' => 'budi111',
                'user_role' => 'pengawas_pool',
            ],
            [
                'user_name' => 'Adam',
                'user_email' => 'adam@domain.com',
                'user_password' => 'adam111',
                'user_role' => 'pengawas_pool',
            ],
            [
                'user_name' => 'Aryo',
                'user_email' => 'aryo@domain.com',
                'user_password' => 'aryo111',
                'user_role' => 'pengawas_pool',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'user_name' => $user['user_name'],
                'user_email' => $user['user_email'],
                'user_password' => Hash::make($user['user_password']),
                'user_role' => $user['user_role'],
            ]);
        }
    }
}
