<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

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

    public function requests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function imageLink() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->image ? Storage::disk('pictures')->url($this->image) : null;
            }
        );
    }
}
