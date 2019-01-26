<?php

namespace App\Providers;

use App\Hire;
use App\Reservation;
use App\VehicleFuelType;
use App\VehicleGearType;
use App\VehicleType;
use Auth;
use App\User;
use App\Vehicle;
use App\WeeklyRate;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('vehicle', function ($value) {
            return Vehicle::withTrashed()->whereSlug($value)->first();
        });

        Route::bind('reservation', function ($value) {
            return Reservation::whereName($value)->first();
        });

        Route::bind('hire', function ($value) {
            return Hire::whereName($value)->first();
        });

        Route::bind('weekly_rate', function ($value) {
            return WeeklyRate::whereSlug($value)->first();
        });

        Route::bind('vehicle_fuel_type', function ($value) {
            return VehicleFuelType::whereSlug($value)->first();
        });

        Route::bind('vehicle_gear_type', function ($value) {
            return VehicleGearType::whereSlug($value)->first();
        });

        Route::bind('vehicle_type', function ($value) {
            return VehicleType::whereSlug($value)->first();
        });

        Route::bind('user', function ($value) {
            return (Auth::user()->id == $value) ? User::find($value) : abort(404);
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
