<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'subtitle', 'description'];
    protected $fillable = ['title', 'subtitle', 'description','url'];
}
