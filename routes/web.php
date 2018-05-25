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
Route::get('/', 'PagesController@home')->name('public.home');
Route::get('/vehicles', 'PagesController@vehicles')->name('public.vehicles');
Route::get('/contact', 'PagesController@contact')->name('public.contact');

/* Administrator routes */
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

Route::get('/admin/vehicles/', 'VehiclesController@all')->name('admin.vehicles');
Route::get('/admin/vehicles/add', 'VehiclesController@showAddForm')->name('vehicle.addForm');
Route::post('/admin/vehicles/add', 'VehiclesController@store')->name('vehicle.add');
Route::post('/admin/vehicles/{make}_{model}_{id}/edit', 'VehiclesController@edit')->name('vehicle.edit');
Route::get('/admin/vehicles/{make}_{model}_{id}/edit', 'VehiclesController@showEditForm')->name('vehicle.editForm');

Route::get('/admin/vehicles/{make}_{model}_{id}', 'VehiclesController@show')->name('vehicle.show');
Route::delete('/admin/vehicles/{make}_{model}_{id}/discontinue', 'VehiclesController@discontinue')->name('vehicle.discontinue');
Route::delete('/admin/vehicles/{make}_{model}_{id}/delete', 'VehiclesController@destroy')->name('vehicle.delete');

Route::get('/admin/reservations/', 'ReservationsController@all')->name('admin.reservations');
Route::get('/admin/hires/', 'HiresController@all')->name('admin.hires');
Route::get('/admin/vehicles/{make}_{model}_{id}/log-reservation', 'ReservationsController@showForm')->name('reservation.form');
Route::post('/admin/vehicles/{make}_{model}_{id}/log-reservation', 'ReservationsController@store')->name('reservation.log');
Route::get('/admin/vehicles/{make}_{model}_{vehicle_id}/reservation-{reservation_id}/edit', 'ReservationsController@showEditForm')->name('reservation.editForm');
Route::post('/admin/vehicles/{make}_{model}_{vehicle_id}/reservation-{reservation_id}/edit', 'ReservationsController@edit')->name('reservation.edit');
Route::get('/admin/vehicles/{make}_{model}_{vehicle_id}/hire-{hire_id}/edit', 'HiresController@showEditForm')->name('hire.editForm');
Route::post('/admin/vehicles/{make}_{model}_{vehicle_id}/hire-{hire_id}/edit', 'HiresController@edit')->name('hire.edit');

Route::delete('/admin/reservations/{id}/cancel', 'ReservationsController@cancel')->name('reservation.cancel');

Route::get('/admin/vehicles/rates/', 'VehicleRatesController@index')->name('vehicle-rate.index');
Route::post('/admin/vehicles/rates/add', 'VehicleRatesController@store')->name('vehicle-rate.add');
Route::get('/admin/vehicles/rates/add', 'VehicleRatesController@showAddForm')->name('vehicle-rate.addForm');
Route::get('/admin/vehicles/rates/{rate}/edit', 'VehicleRatesController@showEditForm')->name('vehicle-rate.editForm');
Route::post('/admin/vehicles/rates/{rate}/edit', 'VehicleRatesController@edit')->name('vehicle-rate.edit');
Route::delete('/admin/vehicles/rates/{rate}/delete', 'VehicleRatesController@destroy')->name('vehicle-rate.delete');

/* Login routes */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

/* Password reset routes */
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

