<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/reservasi', 'App\Http\Controllers\Api\ReservasiController@index');
Route::get('/reservasiAll/{id_user}', 'App\Http\Controllers\Api\ReservasiController@indexById');
Route::get('/reservasi/{id}', 'App\Http\Controllers\Api\ReservasiController@show');
Route::post('/reservasi', 'App\Http\Controllers\Api\ReservasiController@store');
Route::put('/reservasi/{id}', 'App\Http\Controllers\Api\ReservasiController@update');
Route::delete('/reservasi/{id}', 'App\Http\Controllers\Api\ReservasiController@destroy');

Route::get('/user', 'App\Http\Controllers\Api\UserController@index');
Route::get('/user/{id}', 'App\Http\Controllers\Api\UserController@show');
Route::post('/user', 'App\Http\Controllers\Api\UserController@store');
Route::put('/user/{id}', 'App\Http\Controllers\Api\UserController@update');