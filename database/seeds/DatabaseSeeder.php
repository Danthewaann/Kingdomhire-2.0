<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call([
            UsersTableSeeder::class,
            WeeklyRatesTableSeeder::class,
            VehiclesTableSeeder::class,
            VehicleImagesTableSeeder::class,
            ReservationsTableSeeder::class
        ]);
    }
}
