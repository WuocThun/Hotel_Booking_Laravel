<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Hotels
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('hotels/rooms/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'rooms'])->name('hotels.rooms');
Route::get('hotels/rooms-details/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'roomsDetails'])->name('hotels.rooms.details');
Route::post('hotels/rooms-booking/{id}', [App\Http\Controllers\Hotels\HotelsController::class, 'roomBooking'])->name('hotels.rooms.booking');
//Pay
Route::get('hotels/pay', [App\Http\Controllers\Hotels\HotelsController::class, 'payWithPaypal'])->name('hotels.pay');
