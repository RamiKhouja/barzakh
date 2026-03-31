<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Payment;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'courses' => Course::count(),
            'clients' => User::where('role', 'student')->count(),
            'instructors' => Instructor::count(),
            'users' => User::count(),
            'payments' => Payment::where('status', 'successful')->count(),
            'revenue' => Payment::where('status', 'successful')->sum('amount'),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
