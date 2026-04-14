<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;    
use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Partner;

class WelcomeController extends Controller
{
    public function index() 
    {
        $fields = Field::all();
        $mostCourses = Course::orderByDesc('nb_subscriptions')->limit(10)->get();
        $chosenCourses = Course::where('is_chosen', true)->get();
        $recentCourses = Course::withMax('lessons', 'created_at')
            ->orderByRaw('GREATEST(courses.created_at, COALESCE(lessons_max_created_at, courses.created_at)) DESC')
            ->limit(10)
            ->get();
        $courses = [
            "1" =>  $chosenCourses,
            "2" =>  $mostCourses,
            "3" =>  $recentCourses
        ];
        $instructors = Instructor::take(10)->orderBy('order','asc')->get();
        $freeCourses = Course::where('is_free', true)->get();
        $myCourses = null;
        $user = Auth::user();
        if ($user) { 
            $myCourses = $user->courses->map(function ($course) use ($user) {
                $course->completed_lessons = $course->completedLessonsCountByUser($user);
                return $course;
            });
        }
        $partners = Partner::all();
        return view('welcome', compact(['fields', 'courses', 'instructors', 'freeCourses', 'myCourses', 'partners']));
    }
}
