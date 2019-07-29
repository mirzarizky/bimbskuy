<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('resend/{id}', 'AuthController@resend');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@getUser');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('approve/{id}', 'DosenController@approveMahasiswa');
    Route::get('awaited_mahasiswa', 'DosenController@getAwaitedMahasiswa');
});

Route::post('register', 'MahasiswaController@register');
Route::get('departemen', 'DepartemenController@getAllDepartemen');
Route::get('dosen/{id}/departemen', 'DepartemenController@getDosenByDepartemenId');

Route::get('krs/{path}/getKRS', function ($path) {
//    return response()->download(storage_path('app/krs/'.$path));
    if (\Illuminate\Support\Facades\Storage::disk('local')->exists("krs/".$path)) {
        return \Illuminate\Support\Facades\Storage::disk('local')->download("krs/".$path);
    } else {
        return "file not exist or deleted.";
    }
});
