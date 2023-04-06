<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function bookHotel(Request $request)
    {
        $booking = new Booking;
        $booking->user_id = $request->input('user_id');
        $booking->hotel_id = $request->input('hotel_id');
        $booking->check_in = $request->input('check_in');
        $booking->check_out = $request->input('check_out');
        $booking->guests = $request->input('guests');
        $booking->save();

        return response()->json([
            'message' => 'Hotel booked successfully',
            'booking' => $booking
        ]);
    }

    public function bookFlight(Request $request)
    {
        $booking = new Booking;
        $booking->user_id = $request->input('user_id');
        $booking->flight_id = $request->input('flight_id');
        $booking->departure_date = $request->input('departure_date');
        $booking->arrival_date = $request->input('arrival_date');
        $booking->passengers = $request->input('passengers');
        $booking->save();

        return response()->json([
            'message' => 'Flight booked successfully',
            'booking' => $booking
        ]);
    }

    public function viewBookings()
    {
        $user = Auth::user();
        $bookings = $user->bookings;

        return response()->json(['bookings' => $bookings], 200);
    }

    public function show(Booking $booking)
    {
        return response()->json(['booking' => $booking]);
    }
}
