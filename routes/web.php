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
Route::get('/', 'PagesController@welcome');
Route::get('/vehicles', 'PagesController@vehicles');
Route::get('/contact', 'PagesController@contact');

Auth::routes();

Route::get('/admin', 'AdminController@index');
