<?php

namespace App\Console\Commands;

use App\Hire;
use App\Reservation;
use App\Vehicle;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReservationsToHires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduler:reservations-to-hires';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert reservations to hires';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $vehicles = Vehicle::all();
        foreach($vehicles as $vehicle) {
            foreach ($vehicle->reservations as $reservation) {
                if ($reservation->start_date <= date('Y-m-d')) {
                    Hire::create(array(
                        'hired_by' => $reservation->made_by,
                        'rate' => $reservation->rate,
                        'is_active' => ($reservation->end_date >= date('Y-m-d')),
                        'start_date' => $reservation->start_date,
                        'end_date' => $reservation->end_date,
                        'vehicle_id' => $reservation->vehicle->id,
                    ));

                    Reservation::destroy($reservation->id);
                    Log::channel('cron')->info("[ReservationsToHires] Reservation [id = " . $reservation->id .
                        ", start_date = " . $reservation->start_date . ", end_date = " . $reservation->end_date . "] converted to hire");
                }
            }

            if($vehicle->hasActiveHire()) {
                Vehicle::whereId($vehicle->id)->update(['status' => 'Out for hire']);
            }
        }
    }
}
