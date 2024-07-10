<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\LessonUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

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
        
        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('lessons', $fileName, 'pictures');
        }

        $lesson = new Lesson;
        $lesson->title_en = $request->input('title_en');
        $lesson->title_ar = $request->input('title_ar');
        $lesson->course_id = $courseId;
        $lesson->number = $request->input('number');
        $lesson->video_url = $request->input('video_url');
        $lesson->image = "/lessons/{$fileName}";
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
    public function showByCourse($url, $number)
    {
        $course = Course::where('url', $url)->firstOrFail();
        if (!$course) { abort(404); }
        
        if (Auth::check()) {

            $user = auth()->user();
            $successfulPayment = $user->courses()
                ->where('course_id', $course->id)
                ->where('status', 'successful')
                ->first();

            if ($successfulPayment) {
                $lesson = Lesson::where('course_id', $course->id)
                            ->where('number', $number)
                            ->firstOrFail();
                if (!$lesson) { abort(404); }

                $lessonUser = LessonUser::where('lesson_id',$lesson->id)
                                ->where('user_id',$user->id)
                                ->first();

                $courseLessons = Lesson::where('course_id', $course->id)
                            ->orderBy('number')
                            ->get();
                $lessons = $courseLessons->map(function ($l) use ($user) {
                    $lessonUser = $l->users->where('id', $user->id)->first();
                    // if($lessonUser) {
                    //     $l->percent = 'w-['.round($lessonUser->pivot->time_stopped_watching * 100 / $l->duration).'%]';
                    // } else {
                    //     $l->percent = 'w-0';
                    // }
                    $l->lessonUser = $lessonUser;
                    return $l;
                });

                return view('client.courses.lessons', compact(['course','lessons', 'lesson', 'lessonUser']));
            }
            else {
                return redirect()->route('checkout.show', ['course' => $course]);
            }

        } else {
            return redirect()->route('login', ['redirect_to' => route('lesson.showCourse', ['url' => $course->url, 'number' => $number])]);
        }
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

    public function addView(Request $request)
    {
        $userId=$user = auth()->user()->id;
        $lessonId = $request->input('lesson_id');
        $existingRecord = LessonUser::where('lesson_id', $lessonId)
            ->where('user_id', $userId)
            ->first();

        if (!$existingRecord) {
            LessonUser::create([
                'lesson_id' => $lessonId,
                'user_id' => $userId,
                'viewed' => true,
                'time_stopped_watching' => 0,
                'date_viewed' => Carbon::now()
            ]);
        }
    }

    public function updateTime(Request $request)
    {
        $userId=$user = auth()->user()->id;
        $lessonId = $request->input('lesson_id');
        $time = $request->input('time');
        $complete = $request->input('complete');

        $existingRecord = LessonUser::where('lesson_id', $lessonId)
            ->where('user_id', $userId)
            ->first();
        if($existingRecord) {
            LessonUser::where('lesson_id', $lessonId)
                ->where('user_id', $userId)
                ->update([
                    'time_stopped_watching' => $time,
                    'complete' => $complete
                ]);
        }
    }
}
