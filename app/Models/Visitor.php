<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'ip_address',
        'country_code',
        'country_name',
        'region_code',
        'region_name',
        'city_name',
        'user_agent',
        'first_visited_at',
        'last_visited_at',
        'geolocated_at',
    ];

    protected $casts = [
        'first_visited_at' => 'datetime',
        'last_visited_at' => 'datetime',
        'geolocated_at' => 'datetime',
    ];
}
