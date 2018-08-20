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
    Route::get('/', 'PagesController@home')->name('home');
    Route::get('/vehicles', 'PagesController@vehicles')->name('vehicles');
    Route::get('/contact', 'PagesController@contact')->name('contact');
});

/* Administrative private routes */
Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/', 'AdminController@index')->name('home');

        /* Vehicle specific routes */
        Route::name('vehicle.')->group(function () {
            Route::get('/vehicles/{vehicle_id}', 'VehiclesController@show')->name('home');
            Route::get('/vehicles/{vehicle_id}/edit', 'VehiclesController@showEditForm')->name('editForm');
            Route::patch('/vehicles/{vehicle_id}/edit', 'VehiclesController@edit')->name('edit');
            Route::get('/vehicles/{id}/reservations', 'VehiclesController@showReservations')->name('reservations');
            Route::get('/vehicles/{id}/hires', 'VehiclesController@showHires')->name('hires');
            Route::patch('/vehicles/{vehicle_id}/discontinue', 'VehiclesController@discontinue')->name('discontinue');
            Route::patch('/vehicles/{vehicle_id}/re-continue', 'VehiclesController@recontinue')->name('recontinue');
            Route::delete('/vehicles/{vehicle_id}/delete', 'VehiclesController@destroy')->name('delete');
            Route::get('/vehicles/add', 'VehiclesController@showAddForm')->name('addForm');
            Route::post('/vehicles/add', 'VehiclesController@store')->name('add');

            /* Vehicle reservation specific routes */
            Route::name('reservation.')->group(function () {
                Route::get('/vehicles/{vehicle_id}/reservations/add', 'ReservationsController@showForm')->name('addForm');
                Route::post('/vehicles/{vehicle_id}/reservations/add', 'ReservationsController@store')->name('add');
                Route::get('/vehicles/{vehicle_id}/reservations/{reservation_id}/edit', 'ReservationsController@showEditForm')->name('editForm');
                Route::patch('/vehicles/{vehicle_id}/reservations/{reservation_id}/edit', 'ReservationsController@edit')->name('edit');
                Route::delete('/reservations/{reservation_id}/cancel', 'ReservationsController@cancel')->name('cancel');
            });

            /* Vehicle hire specific routes */
            Route::name('hire.')->group(function () {
                Route::get('/vehicles/{vehicle_id}/hires/{hire_id}/edit', 'HiresController@showEditForm')->name('editForm');
                Route::patch('/vehicles/{vehicle_id}/hires/{hire_id}/edit', 'HiresController@edit')->name('edit');
            });
        });

        /* Weekly rates routes */
        Route::get('/rates', 'WeeklyRatesController@index')->name('weekly-rate.index');
        Route::get('/rates/add', 'WeeklyRatesController@showAddForm')->name('weekly-rate.addForm');
        Route::post('/rates/add', 'WeeklyRatesController@store')->name('weekly-rate.add');
        Route::get('/rates/{rate}/edit', 'WeeklyRatesController@showEditForm')->name('weekly-rate.editForm');
        Route::patch('/rates/{rate}/edit', 'WeeklyRatesController@edit')->name('weekly-rate.edit');
        Route::delete('/rates/{rate}/delete', 'WeeklyRatesController@destroy')->name('weekly-rate.delete');
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

