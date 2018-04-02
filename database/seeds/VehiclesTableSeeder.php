<?php

use Illuminate\Database\Seeder;


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
        $this->call(VehicleRatesTableSeeder::class);
        \App\Vehicle::create(array(
            'make' => 'Peugeot',
            'model' => '307',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Manuel',
            'seats' => '4',
            'status' => 'available',
            'type' => 'Hatchback',
            'image_path' => asset('imgs/peugeot_307.jpg'),
            'engine_size' => 'small'
        ));
        \App\Vehicle::create(array(
            'make' => 'Peugeot',
            'model' => '308',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Manuel',
            'seats' => '5',
            'status' => 'available',
            'type' => 'Hatchback',
            'image_path' => asset('imgs/peugeot_308.jpg'),
            'engine_size' => 'small'
        ));
        \App\Vehicle::create(array(
            'make' => 'Renault',
            'model' => 'Master',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel',
            'seats' => '3',
            'status' => 'available',
            'type' => 'Large Van',
            'image_path' => asset('imgs/renault_master.jpg'),
            'engine_size' => 'large'
        ));
        \App\Vehicle::create(array(
            'make' => 'Renault',
            'model' => 'Traffic',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel',
            'seats' => '3',
            'status' => 'available',
            'type' => 'Small Van',
            'image_path' => asset('imgs/renault_traffic.jpg'),
            'engine_size' => 'medium'
        ));
        \App\Vehicle::create(array(
            'make' => 'Kia',
            'model' => 'Sedona',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel/Automatic',
            'seats' => '7',
            'status' => 'available',
            'type' => 'People Carrier',
            'image_path' => asset('imgs/kia_sedona.jpg'),
            'engine_size' => 'medium'
        ));
        \App\Vehicle::create(array(
            'make' => 'Megane',
            'model' => 'Convertable',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Automatic',
            'seats' => '5',
            'status' => 'available',
            'type' => 'Convertable',
            'image_path' => asset('imgs/megane_convertable.jpg'),
            'engine_size' => 'medium'
        ));
    }
}
