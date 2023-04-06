<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HotelController;
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

//التسجيل عن طريق الAPI
Route::post('register', [AuthController::class, 'register']);
//تسجيل الدخول عن طريق الAPI
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    //عرض كل الفنادق المتاحة
    Route::get('hotels', [HotelController::class, 'index']);
    //عرض كل عروض الطيران المتاحة
    Route::get('flights', [FlightController::class, 'index']);
    //البحث عن عرض طيران
    Route::post('flights/search', [FlightController::class, 'searchFlights']);
    //البحث عن فندق
    Route::post('hotels/search', [HotelController::class, 'searchHotels']);
    //حجز فندق
    Route::post('bookings/hotels', [BookingController::class, 'bookHotel']);
    //حجز طيران
    Route::post('bookings/flights', [BookingController::class, 'bookFlight']);
    //عرض بيانات الحجز
    Route::get('bookings/{booking}', [BookingController::class, 'show']);
});
