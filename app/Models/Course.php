<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
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

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function packs()
    {
        return $this->belongsToMany(Pack::class, 'course_packs', 'course_id', 'pack_id');
    }

    public function requests()
    {
        return $this->hasMany(CourseRequest::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function completedLessonsCountByUser(User $user)
    {
        return $this->lessons()
            ->whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('complete', true);
            })
            ->count();
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