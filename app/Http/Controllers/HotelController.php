<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use illuminate\http\request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }

    public function searchhotels(request $request)
    {
        $hotels = Hotel::query()
            ->where('location', $request->input('location'))
            ->wheredoesnthave('bookings', function ($query) use ($request) {
                $query->wherebetween('checkin_date', [$request->input('checkin_date'), $request->input('checkout_date')])
                    ->orwherebetween('checkout_date', [$request->input('checkin_date'), $request->input('checkout_date')]);
            })
            ->get();

        return response()->json(['hotels' => $hotels]);
    }
}
