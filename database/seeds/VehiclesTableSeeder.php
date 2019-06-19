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
        $vehicles = Vehicle::all();
        foreach ($vehicles as $vehicle) {
            $vehicle->forceDelete();
        }
        $weeklyRates = WeeklyRate::all(['id', 'name']);
        $fuelTypes = VehicleFuelType::all(['id', 'name']);
        $gearTypes = VehicleGearType::all(['id', 'name']);
        $vehicleTypes = VehicleType::all(['id', 'name']);

        $vehicles = [
            new Vehicle([
                'make' => 'Mercedes',
                'model' => 'CLC 160',
                'seats' => '4',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Petrol')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Hatchback')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Nissan',
                'model' => 'Note',
                'seats' => '5',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Petrol')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Automatic')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Hatchback')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Kia',
                'model' => 'Sedona',
                'seats' => '7',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Automatic')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'People Carrier')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Citroën',
                'model' => 'Relay',
                'seats' => '3',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Large Van')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Peugeot',
                'model' => '807',
                'seats' => '7',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'People Carrier')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Renault',
                'model' => 'Grand Scenic',
                'seats' => '7',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'People Carrier')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Hyundai',
                'model' => 'Santa Fe',
                'seats' => '7',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Automatic')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'People Carrier')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Citroën',
                'model' => 'C3',
                'seats' => '5',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Petrol')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Hatchback')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Peugeot',
                'model' => '308',
                'seats' => '5',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Hatchback')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Vauxhall',
                'model' => 'Corsa',
                'seats' => '5',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Petrol')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Hatchback')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Renault',
                'model' => 'Master',
                'seats' => '3',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Large Van')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Megane',
                'model' => 'Convertible',
                'seats' => '5',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Petrol')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Automatic')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Convertible')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Kia',
                'model' => 'Sedona',
                'seats' => '7',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'People Carrier')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Renault',
                'model' => 'Traffic',
                'seats' => '3',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Diesel')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Small Van')->first()->id,
                'weekly_rate_id' => null,
            ]),
            new Vehicle([
                'make' => 'Peugeot',
                'model' => '307',
                'seats' => '4',
                'vehicle_fuel_type_id' => $fuelTypes->where('name', 'Petrol')->first()->id,
                'vehicle_gear_type_id' => $gearTypes->where('name', 'Manual')->first()->id,
                'vehicle_type_id' => $vehicleTypes->where('name', 'Hatchback')->first()->id,
                'weekly_rate_id' => null,
            ])
        ];

        foreach ($vehicles as $vehicle) {
            $vehicle->save();
        }
    }
}
