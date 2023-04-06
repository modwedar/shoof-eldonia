<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = [
        'airline', 'origin', 'destination', 'departure_time', 'arrival_time', 'capacity'
    ];
}
