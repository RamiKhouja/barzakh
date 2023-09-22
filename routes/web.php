<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'student'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin fields routes
    Route::get('/admin/field/create', [FieldController::class, 'create'])->name('field.create');
    Route::post('/admin/field', [FieldController::class, 'store'])->name('field.store');
    Route::get('/admin/fields', [FieldController::class, 'index'])->name('admin.fields');

    //Admin instructor routes
    Route::get('/admin/instructor/create', [InstructorController::class, 'create'])->name('instructor.create');
    Route::post('/admin/instructor', [InstructorController::class, 'store'])->name('instructor.store');
    Route::get('/admin/instructors', [InstructorController::class, 'index'])->name('admin.instructors');
    Route::get('/admin/instructor/edit/{instructor}', [InstructorController::class, 'edit'])->name('admin.instructor.edit');
    Route::put('/admin/instructor/{instructor}', [InstructorController::class, 'update'])->name('admin.instructor.update');

    // Admin categories routes
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/category/edit/{category}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/admin/category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/category/{category}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    // Admin courses routes
    Route::get('/admin/course/create', [CourseController::class, 'create'])->name('admin.course.create');
    Route::post('/admin/course', [CourseController::class, 'store'])->name('admin.course.store');
    Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses');
    Route::get('/admin/courses/search', [CourseController::class, 'search'])->name('admin.courses.search');
    Route::get('/admin/course/{course}', [CourseController::class, 'show'])->name('admin.course.show');
    Route::get('/admin/course/edit/{course}', [CourseController::class, 'edit'])->name('admin.course.edit');
    Route::put('/admin/course/{course}', [CourseController::class, 'update'])->name('admin.course.update');
    Route::delete('/admin/course/{course}', [CourseController::class, 'delete'])->name('admin.course.delete');

    // Admin lessons routes
    Route::get('/admin/course/{course}/lesson/create', [LessonController::class, 'create'])->name('admin.lesson.create');
    Route::post('/admin/lesson', [LessonController::class, 'store'])->name('admin.lesson.store');
    Route::get('/admin/lessons', [LessonController::class, 'index'])->name('admin.lessons');
    Route::get('/admin/lesson/edit/{lesson}', [LessonController::class, 'edit'])->name('admin.lesson.edit');
    Route::put('/admin/lesson/{lesson}', [LessonController::class, 'update'])->name('admin.lesson.update');
    Route::delete('/admin/lesson/{lesson}', [LessonController::class, 'delete'])->name('admin.lesson.delete');
});

require __DIR__.'/auth.php';
