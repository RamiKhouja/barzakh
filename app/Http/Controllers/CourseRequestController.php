<?php

namespace App\Http\Controllers;

use App\Models\CourseRequest;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;

class CourseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::has('requests', '>', 0)
            ->with(['requests' => function ($query) {
                $query->where('status', 'pending');
            }])
            ->get()
            ->map(function ($course) {
                return [
                    'course' => $course,
                    'count' => $course->requests->count(),
                ];
            });

        return view('client.requests.index', compact('courses'));
    }

    public function adminIndex() {
        $courses = Course::whereHas('requests', function ($query) {
            $query->where('status', 'pending');
        })
        ->with(['requests' => function ($query) {
            $query->where('status', 'pending')->with('user');
        }])
        ->get();

        return view('admin.request.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId=$user = auth()->user()->id;
        $cr = new CourseRequest;
        $cr->user_id = $userId;
        $cr->course_id=$request->input('course_id');
        $cr->message=$request->input('message');

        $cr->save();

        // $course = Course::findOrFail($cr->course_id);
        return redirect()->route('course.showUrl', ['url' => $cr->course->url])->with('success', 'Course has been updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseRequest $courseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseRequest $courseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseRequest $courseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseRequest $courseRequest)
    {
        //
    }

    public function reject(Request $request, CourseRequest $courseRequest)
    {
        $courseRequest->status = 'rejected';
        $courseRequest->save();

        return redirect()->route('admin.requests')->with('success', 'Request was rejected');
    }

    public function approve(Request $request, CourseRequest $courseRequest)
    {
        $courseRequest->status = 'accepted';
        $courseRequest->save();

        $payment = new Payment();
        $payment->student_id = $courseRequest->user_id;
        $payment->course_id = $courseRequest->course_id;
        $payment->amount = 0;
        $payment->status = 'successful';
        $payment->save();

        $course = Course::findOrFail($courseRequest->course_id);
        $course->nb_offers -= 1;
        $course->save();

        return redirect()->route('admin.requests')->with('success', 'Request was approved');
    }
}
