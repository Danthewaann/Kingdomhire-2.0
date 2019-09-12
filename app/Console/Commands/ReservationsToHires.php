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
        foreach(Vehicle::all() as $vehicle) {
            foreach ($vehicle->reservations as $reservation) {
                if ($reservation->canConvertToHire()) {
                    // Re-save reservation to convert it to a hire
                    $reservation->save();

                    $message = "[ReservationsToHires] Reservation [id = " . $reservation->name .
                    ", start_date = " . $reservation->start_date . ", end_date = " . $reservation->end_date . "] converted to hire";

                    Log::channel('cron')->info($message);
                    $this->info($message);
                }
            }
        }
    }
}
