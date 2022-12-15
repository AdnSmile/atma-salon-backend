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

Route::get('/transaksi', 'App\Http\Controllers\Api\TransaksiController@index');
Route::get('/transaksiAll/{id_user}', 'App\Http\Controllers\Api\TransaksiController@indexById');
Route::get('/transaksi/{id}', 'App\Http\Controllers\Api\TransaksiController@show');
Route::post('/transaksi', 'App\Http\Controllers\Api\TransaksiController@store');
Route::put('/transaksi/{id}', 'App\Http\Controllers\Api\TransaksiController@update');
Route::delete('/transaksi/{id}', 'App\Http\Controllers\Api\TransaksiController@destroy');
Route::delete('/deleteTransaksi/{id}', 'App\Http\Controllers\Api\TransaksiController@deleteTransaksi');

Route::get('/pembayaran', 'App\Http\Controllers\Api\PembayaranController@index');
Route::get('/pembayaranAll/{id_user}', 'App\Http\Controllers\Api\PembayaranController@indexById');
Route::get('/pembayaran/{id}', 'App\Http\Controllers\Api\PembayaranController@show');
Route::post('/pembayaran', 'App\Http\Controllers\Api\PembayaranController@store');
Route::put('/pembayaran/{id}', 'App\Http\Controllers\Api\PembayaranController@update');
Route::delete('/pembayaran/{id}', 'App\Http\Controllers\Api\PembayaranController@destroy');

Route::get('/user', 'App\Http\Controllers\Api\UserController@index');
Route::get('/user/{id}', 'App\Http\Controllers\Api\UserController@show');
Route::post('/user', 'App\Http\Controllers\Api\UserController@store');
Route::put('/user/{id}', 'App\Http\Controllers\Api\UserController@update');