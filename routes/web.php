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

/* Basic page routes */
Route::get('/', 'PagesController@home')->name('home');
Route::get('/vehicles', 'PagesController@vehicles')->name('vehicles');
Route::get('/contact', 'PagesController@contact')->name('contact');

/* Administrator routes */
Route::get('/admin', 'AdminController@index');

Route::get('/admin/vehicles/{make}_{model}/logHire', 'HiresController@showForm')->name('hire.form');
Route::post('/admin/hires/log', 'HiresController@store')->name('hire.log');
Route::delete('/admin/hires/{id}/cancel', 'HiresController@cancel')->name('hire.cancel');

Route::post('/admin/vehicles/add', 'VehiclesController@store')->name('vehicle.add');
Route::get('/admin/vehicles/{make}_{model}', 'VehiclesController@show')->name('vehicle.show');
Route::delete('/admin/vehicles/{make}_{model}/discontinue', 'VehiclesController@discontinue')->name('vehicle.discontinue');

Route::get('/admin/vehicles/{make}_{model}/logReservation', 'ReservationsController@showForm')->name('reservation.form');
Route::post('/admin/reservations/log', 'ReservationsController@store')->name('reservation.log');
Route::delete('/admin/reservations/{id}/cancel', 'ReservationsController@cancel')->name('reservation.cancel');

/* Login routes */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

/* Password reset routes */
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

