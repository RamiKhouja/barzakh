<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePack extends Model
{
    use HasFactory;

    protected $fillable = [ 'course_id', 'pack_id' ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class, 'pack_id');
    }
}
