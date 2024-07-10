<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['firstname', 'lastname', 'short_desc', 'description'];
    protected $fillable = [
        'firstname', 'lastname', 
        'short_desc', 'description',
        'email', 'phone', 'country',
        'image', 'sex'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function imageLink() : Attribute
    {
        return Attribute::make(
            get: function(){
                return Storage::disk('pictures')->url($this->image);
            }
        );
    }
}
