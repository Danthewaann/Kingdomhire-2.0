<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\WeeklyRate;
use App\VehicleType;
use App\VehicleGearType;
use App\VehicleFuelType;
use App\Vehicle;


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
        $small = WeeklyRate::whereName('Small')->first()->id;
        $medium = WeeklyRate::whereName('Medium')->first()->id;
        $large = WeeklyRate::whereName('Large')->first()->id;
        $petrol = VehicleFuelType::whereName('Petrol')->first()->id;
        $diesel = VehicleFuelType::whereName('Diesel')->first()->id;
        $manual = VehicleGearType::whereName('Manual')->first()->id;
        $automatic = VehicleGearType::whereName('Automatic')->first()->id;
        $manualAutomatic = VehicleGearType::whereName('Manual/Automatic')->first()->id;
        $vehicleTypes = [
            'Hatchback' => VehicleType::whereName('Hatchback')->first()->id,
            '4-by-4' => VehicleType::whereName('4-by-4')->first()->id,
            'Large Van' => VehicleType::whereName('Large Van')->first()->id,
            'Small Van' => VehicleType::whereName('Small Van')->first()->id,
            'People Carrier' => VehicleType::whereName('People Carrier')->first()->id,
            '4-door Saloon' => VehicleType::whereName('4-door Saloon')->first()->id,
            'Convertible' => VehicleType::whereName('Convertible')->first()->id
        ];

        Vehicle::create([
            'make' => 'Peugeot',
            'model' => '307',
            'vehicle_fuel_type_id' => $petrol,
            'vehicle_gear_type_id' => $manual,
            'seats' => '4',
            'vehicle_type_id' => $vehicleTypes['Hatchback'],
            'weekly_rate_id' => $small
        ]);
        Vehicle::create([
            'make' => 'Peugeot',
            'model' => '308',
            'vehicle_fuel_type_id' => $petrol,
            'vehicle_gear_type_id' => $manual,
            'seats' => '5',
            'vehicle_type_id' => $vehicleTypes['Hatchback'],
            'weekly_rate_id' => $small
        ]);
        Vehicle::create([
            'make' => 'Renault',
            'model' => 'Master',
            'vehicle_fuel_type_id' => $diesel,
            'vehicle_gear_type_id' => $manual,
            'seats' => '3',
            'vehicle_type_id' => $vehicleTypes['Large Van'],
            'weekly_rate_id' => $large
        ]);
        Vehicle::create([
            'make' => 'Renault',
            'model' => 'Traffic',
            'vehicle_fuel_type_id' => $diesel,
            'vehicle_gear_type_id' => $manual,
            'seats' => '3',
            'vehicle_type_id' => $vehicleTypes['Small Van'],
            'weekly_rate_id' => $medium
        ]);
        Vehicle::create([
            'make' => 'Kia',
            'model' => 'Sedona',
            'vehicle_fuel_type_id' => $diesel,
            'vehicle_gear_type_id' => $manualAutomatic,
            'seats' => '7',
            'vehicle_type_id' => $vehicleTypes['People Carrier'],
            'weekly_rate_id' => $medium
        ]);
        Vehicle::create([
            'make' => 'Megane',
            'model' => 'Convertible',
            'vehicle_fuel_type_id' => $petrol,
            'vehicle_gear_type_id' => $automatic,
            'seats' => '5',
            'vehicle_type_id' => $vehicleTypes['Convertible'],
            'weekly_rate_id' => $medium
        ]);

//        factory(Vehicle::class, 15)->create();
    }
}
