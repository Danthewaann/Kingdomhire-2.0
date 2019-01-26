<?php

use Illuminate\Database\Seeder;
use App\VehicleGearType;

class VehicleGearTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_gear_types')->delete();
        VehicleGearType::create([
            'name' => 'Manual',
        ]);
        VehicleGearType::create([
            'name' => 'Automatic',
        ]);
        VehicleGearType::create([
            'name' => 'Manual/Automatic',
        ]);
    }
}
