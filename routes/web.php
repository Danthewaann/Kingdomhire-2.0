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
Route::get('/', 'PagesController@home')->name('public.home');
Route::get('/vehicles', 'PagesController@vehicles')->name('public.vehicles');
Route::get('/contact', 'PagesController@contact')->name('public.contact');

/* Administrative private routes */
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::get('/admin/vehicles', 'VehiclesController@all')->name('admin.vehicles');
Route::get('/admin/reservations', 'ReservationsController@all')->name('admin.reservations');
Route::get('/admin/hires', 'HiresController@all')->name('admin.hires');

/* Vehicle specific routes */
Route::get('/admin/vehicles/{vehicle_id}', 'VehiclesController@show')->name('vehicle.show')->where('id', '\d+');
Route::get('/admin/vehicles/{vehicle_id}/edit', 'VehiclesController@showEditForm')->name('vehicle.editForm');
Route::patch('/admin/vehicles/{vehicle_id}/edit', 'VehiclesController@edit')->name('vehicle.edit');
Route::get('/admin/vehicles/{id}/reservations', 'VehiclesController@showReservations')->name('vehicle.reservations');
Route::get('/admin/vehicles/{id}/hires', 'VehiclesController@showHires')->name('vehicle.hires');
Route::delete('/admin/vehicles/{vehicle_id}/discontinue', 'VehiclesController@discontinue')->name('vehicle.discontinue');
Route::delete('/admin/vehicles/{vehicle_id}/delete', 'VehiclesController@destroy')->name('vehicle.delete');
Route::get('/admin/vehicles/add', 'VehiclesController@showAddForm')->name('vehicle.addForm');
Route::post('/admin/vehicles/add', 'VehiclesController@store')->name('vehicle.add');

/* Vehicle reservation specific routes */
Route::get('/admin/vehicles/{vehicle_id}/reservations/add', 'ReservationsController@showForm')->name('reservation.form');
Route::post('/admin/vehicles/{vehicle_id}/reservations/add', 'ReservationsController@store')->name('reservation.log');
Route::get('/admin/vehicles/{vehicle_id}/reservations/{reservation_id}/edit', 'ReservationsController@showEditForm')->name('reservation.editForm');
Route::patch('/admin/vehicles/{vehicle_id}/reservations/{reservation_id}/edit', 'ReservationsController@edit')->name('reservation.edit');
Route::delete('/admin/reservations/{reservation_id}/cancel', 'ReservationsController@cancel')->name('reservation.cancel');

/* Vehicle hire specific routes */
Route::get('/admin/vehicles/{vehicle_id}/hires/{hire_id}/edit', 'HiresController@showEditForm')->name('hire.editForm');
Route::patch('/admin/vehicles/{vehicle_id}/hires/{hire_id}/edit', 'HiresController@edit')->name('hire.edit');

/* Vehicle rates routes */
Route::get('/admin/rates', 'VehicleRatesController@index')->name('vehicle-rate.index');
Route::get('/admin/rates/add', 'VehicleRatesController@showAddForm')->name('vehicle-rate.addForm');
Route::post('/admin/rates/add', 'VehicleRatesController@store')->name('vehicle-rate.add');
Route::get('/admin/rates/{rate}/edit', 'VehicleRatesController@showEditForm')->name('vehicle-rate.editForm');
Route::patch('/admin/rates/{rate}/edit', 'VehicleRatesController@edit')->name('vehicle-rate.edit');
Route::delete('/admin/rates/{rate}/delete', 'VehicleRatesController@destroy')->name('vehicle-rate.delete');

/* Login routes */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

/* Password reset routes */
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

