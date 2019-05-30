<?php

use Illuminate\Database\Seeder;
use App\Vehicle;
use App\Reservation;
use Faker\Factory;

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

        // The following creates dummy reservations for every vehicle
        $start_date = strtotime("3 years ago");
        $end_date = strtotime("+3 weeks");
        $vehicles = Vehicle::all();

        foreach ($vehicles as $vehicle) {
            $numOfReservations = rand(15, 40);
            for($i = 0; $i < $numOfReservations; $i++) {
                $reservationLength = rand(3, 10);
                $start = date('Y-m-d', rand($start_date, $end_date));
                $end = date('Y-m-d', strtotime($start . '+ '.$reservationLength.' days'));
                $reservations = Reservation::whereVehicleId($vehicle->id)->get();

                $new = new Reservation([
                    'start_date' => $start,
                    'end_date' => $end,
                    'vehicle_id' => $vehicle->id
                ]);

                if($reservations->isNotEmpty()) {
                    $conflicts = false;
                    foreach ($reservations as $reservation) {
                        $conflicts = $new->conflictsWith($reservation);
                        if($conflicts) {
                            break;
                        }
                    }
                    if(!$conflicts) {
                        $new->save();
                    }
                }
                else {
                    $new->save();
                }
            }
        }
    }
}
