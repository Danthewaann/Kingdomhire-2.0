<?php

use Illuminate\Database\Seeder;
use App\WeeklyRate;

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
        WeeklyRate::create([
            'name' => 'Small',
            'weekly_rate_min' => '50.00',
            'weekly_rate_max' => '100.00'
        ]);
        WeeklyRate::create([
            'name' => 'Medium',
            'weekly_rate_min' => '75.00',
            'weekly_rate_max' => '125.00'
        ]);
        WeeklyRate::create([
            'name' => 'Large',
            'weekly_rate_min' => '100.00',
            'weekly_rate_max' => '150.00'
        ]);
    }
}
