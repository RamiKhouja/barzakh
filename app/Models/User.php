<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'firstname',
        'lastname',
        'role',
        'phone',
        'country',
        'city',
        'birth_date',
        'sex',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'payments', 'student_id', 'course_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_users')
            ->withPivot(['viewed', 'time_stopped_watching', 'date_viewed', 'complete'])
            ->withTimestamps();
    }

    public function requests()
    {
        return $this->hasMany(CourseRequest::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
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
