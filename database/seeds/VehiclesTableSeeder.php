<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\WeeklyRate;
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

        Vehicle::create(array(
            'make' => 'Peugeot',
            'model' => '307',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Manuel',
            'seats' => '4',
            'type' => 'Hatchback',
            'weekly_rate_id' => $small
        ));
        Vehicle::create(array(
            'make' => 'Peugeot',
            'model' => '308',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Manuel',
            'seats' => '5',
            'type' => 'Hatchback',
            'weekly_rate_id' => $small
        ));
        Vehicle::create(array(
            'make' => 'Renault',
            'model' => 'Master',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel',
            'seats' => '3',
            'type' => 'Large Van',
            'weekly_rate_id' => $large
        ));
        Vehicle::create(array(
            'make' => 'Renault',
            'model' => 'Traffic',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel',
            'seats' => '3',
            'type' => 'Small Van',
            'weekly_rate_id' => $medium
        ));
        Vehicle::create(array(
            'make' => 'Kia',
            'model' => 'Sedona',
            'fuel_type' => 'Diesel',
            'gear_type' => 'Manuel/Automatic',
            'seats' => '7',
            'type' => 'People Carrier',
            'weekly_rate_id' => $medium
        ));
        Vehicle::create(array(
            'make' => 'Megane',
            'model' => 'Convertable',
            'fuel_type' => 'Petrol',
            'gear_type' => 'Automatic',
            'seats' => '5',
            'type' => 'Convertable',
            'weekly_rate_id' => $medium
        ));

        factory(Vehicle::class, 15)->create();
    }
}
