<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\ZoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('sport',SportController::class);
Route::resource('location',LocationController::class);
Route::resource('event',EventController::class);
Route::get('/findEventLocation/{id}',[EventController::class,"findEventLocation"]);
Route::resource('matching',MatchingController::class);
Route::resource('booking',BookingController::class);
Route::resource('zone',ZoneController::class);
Route::post('/bookingEvent',[BookingController::class,"bookingEvent"]);