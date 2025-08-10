<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'name',
        'url',
    ];

    public function imageLink() : Attribute
    {
        return Attribute::make(
            get: function(){
                return Storage::disk('pictures')->url($this->logo);
            }
        );
    }
}
