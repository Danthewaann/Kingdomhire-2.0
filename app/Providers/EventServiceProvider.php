<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\VehicleUpdating' => [
            'App\Listeners\VehicleUpdating',
        ],
        'App\Events\VehicleCreating' => [
            'App\Listeners\VehicleCreating',
        ],
        'App\Events\VehicleDeleting' => [
            'App\Listeners\VehicleDeleting',
        ],
        'App\Events\ReservationCreating' => [
            'App\Listeners\ReservationCreating'
        ],
        'App\Events\HireCreating' => [
            'App\Listeners\HireCreating'
        ],
        'App\Events\VehicleGearTypeEvent' => [
            'App\Listeners\VehicleGearTypeListener'
        ],
        'App\Events\VehicleFuelTypeEvent' => [
            'App\Listeners\VehicleFuelTypeListener'
        ],
        'App\Events\VehicleTypeEvent' => [
            'App\Listeners\VehicleTypeListener'
        ],
        'App\Events\WeeklyRateEvent' => [
            'App\Listeners\WeeklyRateListener'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
