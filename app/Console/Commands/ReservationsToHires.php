<?php

namespace App\Console\Commands;

use App\Hire;
use App\Reservation;
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
        $reservations = Reservation::all();
        foreach($reservations as $reservation) {
            if($reservation->start_date <= date('Y-m-d')) {
                Hire::create(array(
                    'hired_by' => $reservation->made_by,
                    'start_date' => $reservation->start_date,
                    'end_date' => $reservation->end_date,
                    'vehicle_id' => $reservation->vehicle->id,
                ));

                DB::table('reservations')
                    ->where('id', '=', $reservation->id)
                    ->delete();

                DB::table('vehicles')
                    ->where('id', '=', $reservation->vehicle->id)
                    ->update(['status' => 'Out for hire']);

                Log::channel('cron')->info("[ReservationsToHires] Reservation [id = ".$reservation->id.
                    ", start_date = ".$reservation->start_date.", end_date = ".$reservation->end_date."] converted to hire");
            }
        }
    }
}
