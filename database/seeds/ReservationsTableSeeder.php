<?php

use Illuminate\Database\Seeder;
use App\Vehicle;
use App\Reservation;
use App\DBQuery;
//use Faker\Generator as Faker;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->delete();
        $start_date = strtotime("2014-01-01");
        $end_date = strtotime("2018-12-31");
        $vehicles = Vehicle::all();
        $faker = Faker\Factory::create();
        foreach ($vehicles as $vehicle) {
            $numOfReservations = rand(1, 100);
            for($i = 0; $i < $numOfReservations; $i++) {
                $reservationLength = rand(3, 10);
                $start = date('Y-m-d', rand($start_date, $end_date));
                $end = date('Y-m-d', strtotime($start . '+ '.$reservationLength.' days'));
                $rate = rand(50, 100);
                $reservations = Reservation::whereVehicleId($vehicle->id)->get();
                if($reservations->isNotEmpty()) {
                    $conflicts = false;
                    foreach ($reservations as $reservation) {
                        if(DBQuery::datesConflict($reservation, $start, $end)) {
                            $conflicts = true;
                            break;
                        }
                    }
                    if(!$conflicts) {
                        Reservation::create([
                            'made_by' => $faker->firstName.' '.$faker->lastName,
                            'rate' => $rate,
                            'start_date' => $start,
                            'end_date' => $end,
                            'vehicle_id' => $vehicle->id
                        ]);
                    }
                }
                else {
                    Reservation::create([
                        'made_by' => $faker->name,
                        'rate' => $rate,
                        'start_date' => $start,
                        'end_date' => $end,
                        'vehicle_id' => $vehicle->id
                    ]);
                }
            }
        }
    }
}
