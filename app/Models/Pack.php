<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Pack extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'domain', 'description'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_packs', 'pack_id', 'course_id');
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
