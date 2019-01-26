<?php

use Illuminate\Database\Seeder;
use App\VehicleType;

class VehicleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_types')->delete();
        VehicleType::create([
            'name' => 'Hatchback',
        ]);
        VehicleType::create([
            'name' => '4-by-4',
        ]);
        VehicleType::create([
            'name' => 'Large Van',
        ]);
        VehicleType::create([
            'name' => 'Small Van',
        ]);
        VehicleType::create([
            'name' => 'People Carrier',
        ]);
        VehicleType::create([
            'name' => '4-door Saloon',
        ]);
        VehicleType::create([
            'name' => 'Convertible',
        ]);
    }
}
