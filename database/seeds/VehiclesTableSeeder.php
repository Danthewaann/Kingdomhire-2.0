<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->delete();
        $small = DB::table('vehicle_rates')->where('engine_size', '=', 'small')->get()->pluck('id')[0];
        $medium = DB::table('vehicle_rates')->where('engine_size', '=', 'medium')->get()->pluck('id')[0];
        $large = DB::table('vehicle_rates')->where('engine_size', '=', 'large')->get()->pluck('id')[0];

        \App\Vehicle::create(array(
            'make' => 'Peugeot',
            'model' => '307',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Manuel',
            'seats' => '4',
            'status' => 'available',
            'type' => 'Hatchback',
            'image_path' => asset('storage/imgs/peugeot_307.jpg'),
            'vehicle_rate_id' => $small
        ));
        \App\Vehicle::create(array(
            'make' => 'Peugeot',
            'model' => '308',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Manuel',
            'seats' => '5',
            'status' => 'available',
            'type' => 'Hatchback',
            'image_path' => asset('storage/imgs/peugeot_308.jpg'),
            'vehicle_rate_id' => $small
        ));
        \App\Vehicle::create(array(
            'make' => 'Renault',
            'model' => 'Master',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel',
            'seats' => '3',
            'status' => 'available',
            'type' => 'Large Van',
            'image_path' => asset('storage/imgs/renault_master.jpg'),
            'vehicle_rate_id' => $large
        ));
        \App\Vehicle::create(array(
            'make' => 'Renault',
            'model' => 'Traffic',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel',
            'seats' => '3',
            'status' => 'available',
            'type' => 'Small Van',
            'image_path' => asset('storage/imgs/renault_traffic.jpg'),
            'vehicle_rate_id' => $medium
        ));
        \App\Vehicle::create(array(
            'make' => 'Kia',
            'model' => 'Sedona',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel/Automatic',
            'seats' => '7',
            'status' => 'available',
            'type' => 'People Carrier',
            'image_path' => asset('storage/imgs/kia_sedona.jpg'),
            'vehicle_rate_id' => $medium
        ));
        \App\Vehicle::create(array(
            'make' => 'Megane',
            'model' => 'Convertable',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Automatic',
            'seats' => '5',
            'status' => 'available',
            'type' => 'Convertable',
            'image_path' => asset('storage/imgs/megane_convertable.jpg'),
            'vehicle_rate_id' => $medium
        ));
    }
}
