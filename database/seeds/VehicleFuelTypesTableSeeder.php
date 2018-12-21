<?php

use Illuminate\Database\Seeder;
use App\VehicleFuelType;

class VehicleFuelTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_fuel_types')->delete();
        VehicleFuelType::create([
            'name' => 'Petrol'
        ]);
        VehicleFuelType::create([
            'name' => 'Diesel'
        ]);
    }
}
