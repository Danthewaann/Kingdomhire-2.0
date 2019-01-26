<?php

namespace App\Listeners;

use App\Events\WeeklyRateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeeklyRateListener
{
    /**
     * Handle the event.
     *
     * @param  WeeklyRateEvent  $event
     * @return void
     */
    public function handle(WeeklyRateEvent $event)
    {
        $weeklyRate = $event->weeklyRate;
        $weeklyRate->slug = str_slug(preg_replace('/[^a-zA-Z0-9]/', ' ', $weeklyRate->name));
    }
}
