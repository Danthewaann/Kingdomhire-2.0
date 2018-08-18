<?php

use Illuminate\Database\Seeder;

class WeeklyRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weekly_rates')->delete();
        \App\WeeklyRate::create(array(
            'name' => 'Small',
            'weekly_rate_min' => '50.00',
            'weekly_rate_max' => '100.00'
        ));
        \App\WeeklyRate::create(array(
            'name' => 'Medium',
            'weekly_rate_min' => '75.00',
            'weekly_rate_max' => '125.00'
        ));
        \App\WeeklyRate::create(array(
            'name' => 'Large',
            'weekly_rate_min' => '100.00',
            'weekly_rate_max' => '150.00'
        ));
    }
}
