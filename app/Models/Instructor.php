<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
