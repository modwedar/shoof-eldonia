<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        return response()->json($flights);
    }

    public function searchFlights(Request $request)
    {
        $flights = Flight::query()
            ->where('origin_id', $request->input('origin_id'))
            ->where('destination_id', $request->input('destination_id'))
            ->where('departure_date', $request->input('departure_date'))
            ->get();

        return response()->json(['flights' => $flights]);
    }
}
