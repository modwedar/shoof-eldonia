<?php

namespace app\http\controllers;

use app\models\hotel;
use illuminate\http\request;

class hotelcontroller extends controller
{
    public function index()
    {
        $hotels = hotel::all();
        return response()->json($hotels);
    }

    public function searchhotels(request $request)
    {
        $hotels = hotel::query()
            ->where('location', $request->input('location'))
            ->wheredoesnthave('bookings', function ($query) use ($request) {
                $query->wherebetween('checkin_date', [$request->input('checkin_date'), $request->input('checkout_date')])
                    ->orwherebetween('checkout_date', [$request->input('checkin_date'), $request->input('checkout_date')]);
            })
            ->get();

        return response()->json(['hotels' => $hotels]);
    }
}
