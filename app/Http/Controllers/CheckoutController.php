<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;

class CheckoutController extends Controller
{
    public function show(Course $course)
    {
        $payment = new Payment();
        $payment->student_id = auth()->user()->id; // Assuming user is authenticated
        $payment->course_id = $course->id;
        $payment->amount = $course->is_discount ? $course->discount_price : $course->price; // Convert back to dollars
        $payment->status = 'successful';
        $payment->save();

        return redirect()->route('course.showUrl', ['url' => $course->url]);
    }
}
