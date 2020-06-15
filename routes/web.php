<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Public page routes */
Route::name('public.')->group(function () {
    Route::get('/sitemap', 'PublicController@siteMap')->name('siteMap');
    Route::get('/', 'PublicController@home')->name('root');
    Route::get('/home', 'PublicController@home')->name('home');
    Route::get('/vehicles', 'PublicController@vehicles')->name('vehicles');
    Route::get('/contact-us', 'PublicController@contact')->name('contact');
    Route::post('/contact-us', 'PublicController@postContactForm')->name('postContact');
});


/* Administrative private routes */
Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/', 'AdminController@home')->name('home');
        Route::get('/report', 'AdminController@generateHiresPerVehicleReport')->name('report');

        /* Vehicle specific routes */
        Route::resource('vehicles', 'VehiclesController')->only([
            'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
        Route::patch('/vehicles/{vehicle}/discontinue', 'VehiclesController@discontinue')->name('vehicles.discontinue');
        Route::patch('/vehicles/{vehicle}/re-continue', 'VehiclesController@recontinue')->name('vehicles.recontinue');

        Route::prefix('other')->group(function () {
            /* Vehicle fuel types specific routes */
            Route::resource('vehicle-fuel-types', 'VehicleFuelTypesController')->only([
                'index', 'create', 'store', 'edit', 'update', 'destroy'
            ]);

            /* Vehicle gear types specific routes */
            Route::resource('vehicle-gear-types', 'VehicleGearTypesController')->only([
                'index', 'create', 'store', 'edit', 'update', 'destroy'
            ]);

            /* Vehicle types specific routes */
            Route::resource('vehicle-types', 'VehicleTypesController')->only([
                'index', 'create', 'store', 'edit', 'update', 'destroy'
            ]);

            /* Weekly rate specific routes */
            Route::resource('weekly-rates', 'WeeklyRatesController')->only([
                'index', 'create', 'store', 'edit', 'update', 'destroy'
            ]);
        });

        /* Reservation specific routes */
        Route::resource('reservations', 'ReservationsController')->only([
            'store', 'edit', 'update', 'destroy'
        ]);

        /* Hire specific routes */
        Route::resource('hires', 'HiresController')->only([
            'edit', 'update', 'destroy'
        ]);

        /* User specific routes */
        Route::get('/users/me/edit', 'UsersController@edit')->name('users.edit');
        Route::patch('/users/me/update', 'UsersController@update')->name('users.update');
        Route::get('/users/me/change-password', 'UsersController@editPassword')->name('users.edit-password');
        Route::patch('/users/me/change-password', 'UsersController@updatePassword')->name('users.update-password');
    });
});

/* Login routes */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

/* Password reset routes */
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

