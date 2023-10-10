<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Instructor;
use App\Models\Course;

class WelcomeController extends Controller
{
    public function index() 
    {
        $fields = Field::all();
        $mostCourses = Course::orderByDesc('nb_subscriptions')->limit(10)->get();
        $chosenCourses = Course::where('is_chosen', true)->get();
        $recentCourses = Course::orderBy('created_at', 'desc')->limit(10)->get();
        $courses = [
            "1" =>  $chosenCourses,
            "2" =>  $mostCourses,
            "3" =>  $recentCourses
        ];
        $instructors = Instructor::take(8)->get();
        return view('welcome', compact(['fields', 'courses', 'instructors']));
    }
}