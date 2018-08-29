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
        Route::get('/', 'AdminController')->name('home');

        /* Vehicle specific routes */
        Route::resource('vehicles', 'VehiclesController')->only([
            'show', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
        Route::patch('/vehicles/{vehicle}/discontinue', 'VehiclesController@discontinue')->name('vehicles.discontinue');
        Route::patch('/vehicles/{vehicle}/re-continue', 'VehiclesController@recontinue')->name('vehicles.recontinue');

        /* Reservation specific routes */
        Route::resource('reservations', 'ReservationsController')->only([
            'store', 'edit', 'update', 'destroy'
        ]);

        /* Hire specific routes */
        Route::resource('hires', 'HiresController')->only([
            'edit', 'update',
        ]);

        /* Weekly rate specific routes */
        Route::resource('weekly-rates', 'WeeklyRatesController')->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);

        /* User specific routes */
        Route::resource('users', 'UsersController')->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
        Route::get('/users/{user}/change-password', 'UsersController@editPassword')->name('users.edit-password');
        Route::patch('/users/{user}/change-password', 'UsersController@updatePassword')->name('users.update-password');
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

