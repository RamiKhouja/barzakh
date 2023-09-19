<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en', 
        'title_ar', 
        'url', 
        'field_id',
        'description_en',
        'description_ar',
        'image'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'category_courses', 'category_id', 'course_id');
    }
}
