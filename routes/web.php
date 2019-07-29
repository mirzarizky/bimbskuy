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

Route::get('mail/verify/{id}', 'AuthController@verify')->name('mail.verify')->middleware('signed');;
Route::get('password/new/{id}', 'MahasiswaController@makeNewPassword')->name('password.new')->middleware('signed');;
