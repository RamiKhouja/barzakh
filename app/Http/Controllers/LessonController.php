<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('admin.lesson.create', compact('course'));
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
            'video_url' => 'required|string',
            'number' => 'required',
            'hours' => 'required',
            'minutes' => 'required',
            'seconds' => 'required',
            'is_free' => 'nullable',
            'course_id' => 'required'
        ]);

        $courseId = intval($request->input('course_id'));
        
        $path = null;
        if($request->hasFile('picture')) {
            $picFolder = 'pictures/lessons'.$courseId;
            $path = $request->file('picture')->storePublicly($picFolder);
        }

        $lesson = new Lesson;
        $lesson->title_en = $request->input('title_en');
        $lesson->title_ar = $request->input('title_ar');
        $lesson->course_id = $courseId;
        $lesson->number = $request->input('number');
        $lesson->video_url = $request->input('video_url');
        $lesson->image = $path;
        $lesson->url = strtolower(str_replace(' ', '-', trim($request->input('title_en'))));
        $lesson->description_en = $request->input('description_en');
        $lesson->description_ar = $request->input('description_ar');
        $lesson->duration = $request->input('hours')*3600 + $request->input('minutes')*60 + $request->input('seconds');
        $isFree = $request->has('is_free');
        $isVisible = $request->has('is_visible');
        $lesson->is_free = $isFree;
        $lesson->is_visible = $isVisible;

        $lesson->save();

        $course = Course::findOrFail($courseId);
        $course->nb_lessons += 1;
        $course->duration += $lesson->duration;
        $course->save();

        return Redirect::route('admin.courses')->with('success','Lesson has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        return view('admin.lesson.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'required|string',
            'number' => 'required',
            'hours' => 'required',
            'minutes' => 'required',
            'seconds' => 'required',
            'is_free' => 'nullable'
        ]);

        $prev_duration = $lesson->duration;

        $path = $lesson->image; // Use the existing image path by default
        if ($request->hasFile('picture')) {
            $picFolder = 'pictures/lessons'.$lesson->course_id;
            $path = $request->file('picture')->storePublicly($picFolder);
        }

        $lesson->title_en = $request->input('title_en');
        $lesson->title_ar = $request->input('title_ar');
        $lesson->number = $request->input('number');
        $lesson->video_url = $request->input('video_url');
        $lesson->image = $path;
        $lesson->url = strtolower(str_replace(' ', '-', trim($request->input('title_en'))));
        $lesson->description_en = $request->input('description_en');
        $lesson->description_ar = $request->input('description_ar');
        $lesson->duration = $request->input('hours')*3600 + $request->input('minutes')*60 + $request->input('seconds');
        $isFree = $request->has('is_free');
        $isVisible = $request->has('is_visible');
        $lesson->is_free = $isFree;
        $lesson->is_visible = $isVisible;

        $lesson->save();

        if($prev_duration != $lesson->duration) {
            $course = Course::findOrFail($lesson->course_id);
            $course->duration += $lesson->duration;
            $course->duration -= $prev_duration;
            $course->save();
        }

        return Redirect::route('admin.course.show', ['course' => $lesson->course_id])->with('success','Lesson has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Lesson $lesson)
    {
        $lesson->delete();
        $course = Course::findOrFail($lesson->course_id);
        $course->nb_lessons = max(0, $course->nb_lessons - 1);
        $course->duration = max(0, $course->duration - $lesson->duration);
        $course->save();
        return redirect()->route('admin.course.show', ['course' => $lesson->course_id])->with('success', 'Lesson deleted successfully');
    }
}
