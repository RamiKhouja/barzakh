<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Payment;
use App\Models\User;
use App\Models\Visitor;
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
            'visitors_total' => Visitor::count(),
            'visitors_month' => Visitor::whereBetween('last_visited_at', [now()->startOfMonth(), now()->endOfMonth()])->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
