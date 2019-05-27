<?php

namespace App\Console\Commands;

use App\Hire;
use App\Vehicle;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ActiveToInactiveHires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduler:active-to-inactive-hires';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set past active hires to inactive hires';

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
        foreach ($vehicles as $vehicle) {
            $activeHire = $vehicle->getActiveHire();
            if ($activeHire != null) {
                if ($activeHire->end_date <= date('Y-m-d')) {
                    Hire::whereId($activeHire->id)->update(['is_active' => false]);
                    Vehicle::whereId($vehicle->id)->update(['status' => 'Available']);

                    $message = "[ActiveToInactiveHires] Active hire [id = " . $activeHire->name .
                    ", start_date = " . $activeHire->start_date . ", end_date = " . $activeHire->end_date . "] set to inactive";

                    Log::channel('cron')->info($message);
                    $this->info($message);
                }
            }
        }
    }
}
