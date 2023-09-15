<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_courses', 'course_id', 'category_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'payments');
    }
}
