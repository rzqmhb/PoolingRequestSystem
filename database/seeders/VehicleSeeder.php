<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Manhauler 1',
                'type' => 'Angkutan Orang',
            ],
            [
                'name' => 'Manhauler 2',
                'type' => 'Angkutan Orang',
            ],
            [
                'name' => 'Manhauler 3',
                'type' => 'Angkutan Orang',
            ],
            [
                'name' => 'Manhauler 4',
                'type' => 'Angkutan Orang',
            ],
            [
                'name' => 'Truck 1',
                'type' => 'Angkutan Barang',
            ],
            [
                'name' => 'Truck 2',
                'type' => 'Angkutan Barang',
            ],
            [
                'name' => 'Truck 3',
                'type' => 'Angkutan Barang',
            ],
            [
                'name' => 'Truck 4',
                'type' => 'Angkutan Barang',
            ],
            [
                'name' => 'Truck 5',
                'type' => 'Angkutan Barang',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            DB::table('vehicles')->insert([
                'vehicle_name' => $vehicle['name'],
                'vehicle_type' => $vehicle['type'],
            ]);
        }
    }
}
