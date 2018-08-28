<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\WeeklyRate;


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
        $small = WeeklyRate::find('Small')->name;
        $medium = WeeklyRate::find('Medium')->name;
        $large = WeeklyRate::find('Large')->name;

        \App\Vehicle::create(array(
            'make' => 'Peugeot',
            'model' => '307',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Manuel',
            'seats' => '4',
            'type' => 'Hatchback',
            'weekly_rate' => $small
        ));
        \App\Vehicle::create(array(
            'make' => 'Peugeot',
            'model' => '308',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Manuel',
            'seats' => '5',
            'type' => 'Hatchback',
            'weekly_rate' => $small
        ));
        \App\Vehicle::create(array(
            'make' => 'Renault',
            'model' => 'Master',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel',
            'seats' => '3',
            'type' => 'Large Van',
            'weekly_rate' => $large
        ));
        \App\Vehicle::create(array(
            'make' => 'Renault',
            'model' => 'Traffic',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel',
            'seats' => '3',
            'type' => 'Small Van',
            'weekly_rate' => $medium
        ));
        \App\Vehicle::create(array(
            'make' => 'Kia',
            'model' => 'Sedona',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel/Automatic',
            'seats' => '7',
            'type' => 'People Carrier',
            'weekly_rate' => $medium
        ));
        \App\Vehicle::create(array(
            'make' => 'Megane',
            'model' => 'Convertable',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Automatic',
            'seats' => '5',
            'type' => 'Convertable',
            'weekly_rate' => $medium
        ));

        factory(\App\Vehicle::class, 15)->create();
    }
}
