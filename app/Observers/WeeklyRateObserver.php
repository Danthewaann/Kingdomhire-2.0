<?php

namespace App\Observers;

use App\WeeklyRate;

class WeeklyRateObserver
{
    /**
     * Handle the weekly rate "saving" event.
     *
     * @param  \App\WeeklyRate  $weeklyRate
     * @return void
     */
    public function saving(WeeklyRate $weeklyRate)
    {
        // Set the slug of the fuel type to be its name with special characters replaced with ' ' 
        $weeklyRate->slug = str_slug(preg_replace('/[^a-zA-Z0-9]/', ' ', $weeklyRate->name));
    }
}
