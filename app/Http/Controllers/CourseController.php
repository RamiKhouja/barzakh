<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Category;
use App\Models\CategoryCourse;
use App\Models\Instructor;
use App\Models\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;   
use Illuminate\Support\Facades\Storage; 

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $instructors = Instructor::all();
        return view('admin.course.create', compact(['categories', 'instructors']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'instructor_id' => 'required',
            'price' => 'required',
            'discount_price' => 'nullable',
            'featured_vid' => 'nullable',
            'categories' => 'required',
            'is_free' => 'nullable',
            'is_chosen' => 'nullable',
            'is_discount' => 'nullable',
            'discount_start' => 'nullable',
            'discount_end' => 'nullable'
        ]);
        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/courses', $fileName, 'pictures');
        }

        $course = new Course;
        $course->title_en = $request->input('title_en');
        $course->title_ar = $request->input('title_ar');
        $course->description_en = $request->input('description_en');
        $course->description_ar = $request->input('description_ar');
        $course->instructor_id = $request->input('instructor_id');
        $course->price = $request->input('price');
        $course->is_free = $request->has('is_free');
        $course->is_chosen = $request->has('is_chosen');
        $course->is_discount = $request->has('is_discount');
        if($request->has('is_discount')) {
            $course->discount_price = $request->input('discount_price');
            if($course->discount_price != null && $course->discount_price > 0) {
                $course->discount = round((($course->price - $course->discount_price) / $course->price) * 100, 1);
                $course->discount_start = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('discount_start'));
                $course->discount_end = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('discount_end'));
            }
        }
        $course->featured_vid = $request->input('featured_vid');
        $course->image = "/courses/{$fileName}";
        $course->url = strtolower(str_replace(' ', '-', trim($request->input('title_en'))));
        $course->level= $request->input('level');
        $requirements_en = $request->input('requirements_en', []);
        $course->requirements_en = json_encode($requirements_en);
        $requirements_ar = $request->input('requirements_ar', []);
        $course->requirements_ar = json_encode($requirements_ar);

        $translations = $request->input('translations', []);
        $course->translations = json_encode($translations);

        $course->save();

        $categories = $request->input('categories');
        foreach ($categories as $category) {
            $cat = Category::findOrFail($category);
            CategoryCourse::create([
                'course_id' => $course->id,
                'category_id' => $cat->id
            ]);
        }

        $instructor = Instructor::findOrFail($course->instructor_id);
        $instructor->nb_courses = $instructor->nb_courses + 1;
        $instructor->save();

        return Redirect::route('admin.courses')->with('success','Course has been created successfully.');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('q');
        
        // Perform the search based on the $searchTerm, e.g., by course title
        $courses = Course::where('title_en', 'like', "%$searchTerm%")->get();
        
        return view('admin.courses', compact('courses'));
    }

    public function clientSearch(Request $request)
    {
        $query = $request->input('query');

        // Search for courses or instructors where the name contains the query
        $courses = Course::where('title_en', 'LIKE', '%' . $query . '%')
            ->orWhere('title_ar', 'LIKE', '%' . $query . '%')
            ->get();
        //$instructors = Instructor::where('name', 'LIKE', '%' . $query . '%')->get();

        return view('client.search', compact('courses'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $lessons = Lesson::where('course_id', $course->id)->orderBy('number')->get();
        return view('admin.course.show', compact(['course','lessons']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $instructors = Instructor::all();
        $selectedCategories = CategoryCourse::where('course_id', $course->id)->pluck('category_id')->toArray();
        return view('admin.course.edit', compact(['course','categories', 'instructors', 'selectedCategories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'instructor_id' => 'required',
            'price' => 'required',
            'discount_price' => 'nullable',
            'featured_vid' => 'nullable',
            'categories' => 'required',
            'is_free' => 'nullable',
            'is_chosen' => 'nullable'
        ]);
        $previousInstructorId = $course->instructor_id;

        if ($request->hasFile('picture')) {
            // If a new image is uploaded, replace the existing one
            $path = $request->file('picture')->storePublicly('pictures/courses');
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/courses', $fileName, 'pictures'); 
            $course->image="/courses/{$fileName}";
        }

        $course->title_en = $request->input('title_en');
        $course->title_ar = $request->input('title_ar');
        $course->description_en = $request->input('description_en');
        $course->description_ar = $request->input('description_ar');
        $course->instructor_id = $request->input('instructor_id');
        $course->price = $request->input('price');
        $isFree = $request->has('is_free');
        $isChosen = $request->has('is_chosen');
        $course->is_free = $isFree;
        $course->is_chosen = $isChosen;
        $course->discount_price = $request->input('discount_price');
        $course->language = $request->input('language');
        
        if ($course->discount_price != null && $course->discount_price > 0) {
            $course->discount = round((($course->price - $course->discount_price) / $course->price) * 100, 1);
        } else {
            $course->discount = null; // Reset the discount if no discount price is provided
        }

        $course->featured_vid = $request->input('featured_vid');
        $course->url = $request->input('url');
        $course->level = $request->input('level');
        
        $requirements_en = $request->input('requirements_en', []);
        $course->requirements_en = json_encode($requirements_en);
        $requirements_ar = $request->input('requirements_ar', []);
        $course->requirements_ar = json_encode($requirements_ar);

        $translations = $request->input('translations', []);
        $course->translations = json_encode($translations);

        if ($previousInstructorId !== $course->instructor_id) {
            $previousInstructor = Instructor::findOrFail($previousInstructorId);
            $previousInstructor->nb_courses = max(0, $previousInstructor->nb_courses - 1);
            $previousInstructor->save();
    
            $newInstructor = Instructor::findOrFail($course->instructor_id);
            $newInstructor->nb_courses = $newInstructor->nb_courses + 1;
            $newInstructor->save();
        }

        $course->save();

        // Sync the categories for the course
        $categoryIds = $request->input('categories', []);
        //$course->categories()->sync($categories);
        $course->categories()->detach();
        foreach ($categoryIds as $categoryId) {
            $course->categories()->attach($categoryId);
        }

        return redirect()->route('admin.courses')->with('success', 'Course has been updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(Course $course)
    {
        $course->delete();
        $instructor = Instructor::findOrFail($course->instructor_id);
        $instructor->nb_courses = max(0, $instructor->nb_courses - 1);
        $instructor->save();
        return redirect()->route('admin.courses')->with('success', 'Course deleted successfully');
    }

    public function showByUrl($url)
    {
        $course = Course::where('url', $url)->with('lessons')->first();
        if (!$course) { abort(404); }
        $categories = $course->categories;
        
        $payment = null;
        if (Auth::check()) {
            $p=Payment::where('student_id', auth()->user()->id)
                        ->where('course_id',$course->id)->first();
            if($p) {
                $payment = $p;
            }
        }

        return view('client.courses.show', compact(['course', 'categories', 'payment']));
    }

    public function myCourses()
    {
        $user = Auth::user();
        if (!$user) { abort(404); }
        $courses = $user->courses->map(function ($course) use ($user) {
            $course->completed_lessons = $course->completedLessonsCountByUser($user);
            return $course;
        });
        $requested = $user->requests;
        return view('client.profile.courses', compact(['courses','requested']));
    }
}
