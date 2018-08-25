<?php

use Faker\Generator as Faker;

$factory->define(App\Vehicle::class, function (Faker $faker) {
    return [
        'make' => $faker->lastName,
        'model' => $faker->lastName,
        'fuel_type' => 'Petrol',
        'gear_type' => 'Manuel',
        'seats' => rand(1, 9),
        'type' => \App\Vehicle::$types[rand(0, count(\App\Vehicle::$types)-1)]
    ];
});
