<?php

namespace App\Console\Commands;

use App\Vehicle;
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
        foreach (Vehicle::all() as $vehicle) {
            $activeHire = $vehicle->active_hire;
            if ($activeHire != null) {
                if ($activeHire->end_date <= date('Y-m-d')) {
                    // Re-save hire to convert it into an inactive hire
                    $activeHire->save();

                    $message = "[ActiveToInactiveHires] Active hire [id = " . $activeHire->name .
                    ", start_date = " . $activeHire->start_date . ", end_date = " . $activeHire->end_date . "] set to inactive";

                    Log::channel('cron')->info($message);
                    $this->info($message);
                }
            }
        }
    }
}
