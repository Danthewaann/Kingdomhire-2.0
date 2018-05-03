<?php

namespace App\Console\Commands;

use App\DBQuery;
use App\Hire;
use DB;
use Illuminate\Console\Command;

class ReservationsToHires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduler:ReservationsToHires';

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
        $reservations = DBQuery::getReservations();
        foreach($reservations as $reservation) {
            if($reservation->start_date <= date('Y-m-d')) {
                Hire::create(array(
                    'start_date' => $reservation->start_date,
                    'end_date' => $reservation->end_date,
                    'vehicle_id' => $reservation->vehicle->id,
                ));

                DB::table('reservations')->where('id', '=', $reservation->id)->delete();
            }

        }
    }
}
