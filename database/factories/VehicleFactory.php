<?php

use Faker\Generator as Faker;
use Faker\Provider\Fakecar as carFaker;
use App\Vehicle;
use App\WeeklyRate;
use App\VehicleType;
use App\VehicleFuelType;
use App\VehicleGearType;

$factory->define(Vehicle::class, function (Faker $faker) {
    $faker->addProvider(new carFaker($faker));
    $v = $faker->vehicleArray();
    return [
        'make' => $v['brand'],
        'model' => $v['model'],
        'seats' => $faker->vehicleSeatCount,
        'weekly_rate_id' => WeeklyRate::inRandomOrder()->first() != null ? WeeklyRate::inRandomOrder()->first()->id : null,
        'vehicle_fuel_type_id' => VehicleFuelType::inRandomOrder()->first() != null ? VehicleFuelType::inRandomOrder()->first()->id : null,
        'vehicle_gear_type_id' => VehicleGearType::inRandomOrder()->first() != null ? VehicleGearType::inRandomOrder()->first()->id : null,
        'vehicle_type_id' => VehicleType::inRandomOrder()->first() != null ? VehicleType::inRandomOrder()->first()->id : null
    ];
});
