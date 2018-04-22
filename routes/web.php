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
Route::post('/admin/deleteVehicle', 'AdminController@deleteVehicle');
Route::post('/admin/addVehicle', 'AdminController@addVehicle');
Route::get('/admin/reservation', 'AdminController@getReservationForm');
Route::post('/admin/logReservation', 'AdminController@logReservation');
Route::post('/admin/deleteReservation', 'AdminController@deleteReservation');
Route::get('/admin/hire', 'AdminController@getHireForm');
Route::post('/admin/logHire', 'AdminController@logHire');
Route::post('/admin/deleteHire', 'AdminController@deleteHire');

/* Login routes */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

/* Password reset routes */
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

