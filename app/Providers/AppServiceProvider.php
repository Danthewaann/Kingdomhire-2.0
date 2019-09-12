<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Vehicle;
use App\Reservation;
use App\Hire;
use App\VehicleType;
use App\VehicleFuelType;
use App\VehicleGearType;
use App\WeeklyRate;
use App\Observers\VehicleObserver;
use App\Observers\ReservationObserver;
use App\Observers\HireObserver;
use App\Observers\VehicleTypeObserver;
use App\Observers\VehicleFuelTypeObserver;
use App\Observers\VehicleGearTypeObserver;
use App\Observers\WeeklyRateObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Registering observer classes
        Vehicle::observe(VehicleObserver::class);
        Reservation::observe(ReservationObserver::class);
        Hire::observe(HireObserver::class);
        VehicleType::observe(VehicleTypeObserver::class);
        VehicleFuelType::observe(VehicleFuelTypeObserver::class);
        VehicleGearType::observe(VehicleGearTypeObserver::class);
        WeeklyRate::observe(WeeklyRateObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
