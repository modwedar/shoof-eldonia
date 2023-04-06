<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }

    public function searchHotels(Request $request)
    {
        $hotels = Hotel::query()
            ->where('location', $request->input('location'))
            ->whereDoesntHave('bookings', function ($query) use ($request) {
                $query->whereBetween('checkin_date', [$request->input('checkin_date'), $request->input('checkout_date')])
                    ->orWhereBetween('checkout_date', [$request->input('checkin_date'), $request->input('checkout_date')]);
            })
            ->get();

        return response()->json(['hotels' => $hotels]);
    }
}
