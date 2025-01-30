<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en', 
        'title_ar', 
        'url', 
        'price',
        'description_en',
        'description_ar',
        'image'
    ];
}
