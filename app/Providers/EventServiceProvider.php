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
        'App\Events\VehicleCreating' => [
            'App\Listeners\VehicleCreating',
        ],
        'App\Events\ReservationCreating' => [
            'App\Listeners\ReservationCreating'
        ],
        'App\Events\HireCreating' => [
            'App\Listeners\HireCreating'
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
