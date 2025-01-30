<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CourseRequestController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;

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

Route::get('/public', [WelcomeController::class, 'index']);
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::post('/set-locale', [LocaleController::class, 'setLocale'])->name('setLocale');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'student'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/courses', [CourseController::class, 'myCourses'])->name('profile.courses');
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
    Route::delete('/admin/instructor/{instructor}', [InstructorController::class, 'delete'])->name('admin.instructor.delete');

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

    // Admin courses routes
    Route::get('/admin/pack/create', [PackController::class, 'create'])->name('admin.pack.create');
    Route::post('/admin/pack', [PackController::class, 'store'])->name('admin.pack.store');
    Route::get('/admin/packs', [PackController::class, 'index'])->name('admin.packs');
    Route::delete('/admin/pack/{pack}', [PackController::class, 'delete'])->name('admin.pack.delete');
    Route::get('/admin/pack/edit/{pack}', [PackController::class, 'edit'])->name('admin.pack.edit');
    Route::put('/admin/pack/{pack}', [PackController::class, 'update'])->name('admin.pack.update');

    //Admin offers routes
    Route::get('/admin/offers', [OfferController::class, 'adminIndex'])->name('admin.offers');

    //Admin requests routes
    Route::get('/admin/requests', [CourseRequestController::class, 'adminIndex'])->name('admin.requests');
    Route::put('/admin/request/reject/{courseRequest}', [CourseRequestController::class, 'reject'])->name('admin.request.reject');
    Route::put('/admin/request/approve/{courseRequest}', [CourseRequestController::class, 'approve'])->name('admin.request.approve');

    Route::get('/admin/service/create', [ServiceController::class, 'create'])->name('admin.service.create');
    Route::post('/admin/service', [ServiceController::class, 'store'])->name('admin.service.store');
    Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services');
    Route::get('/admin/service/edit/{service}', [ServiceController::class, 'edit'])->name('admin.service.edit');
    Route::put('/admin/service/{service}', [ServiceController::class, 'update'])->name('admin.service.update');
    Route::delete('/admin/service/{service}', [ServiceController::class, 'delete'])->name('admin.service.delete');
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/checkout/{course}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/lesson/addView', [LessonController::class, 'addView'])->name('lesson.addview');
    Route::post('/lesson/updateTime', [LessonController::class, 'updateTime'])->name('lesson.updateTime');
    Route::post('/request/store', [CourseRequestController::class, 'store'])->name('request.store');
    Route::get('/requests', [CourseRequestController::class, 'index'])->name('requests');
    Route::post('/offer/store', [OfferController::class, 'store'])->name('offer.store');
    Route::get('/offers', [OfferController::class, 'index'])->name('offers');
});

// Guest Routes
Route::get('/categories/{url}', [FieldController::class, 'showByUrl'])->name('fields.showUrl');
Route::get('/courses/{url}', [CategoryController::class, 'showByUrl'])->name('category.showUrl');
Route::get('/course/{url}', [CourseController::class, 'showByUrl'])->name('course.showUrl');
Route::get('/course/{url}/{number}', [LessonController::class, 'showByCourse'])->name('lesson.showCourse');
Route::get('/instructor/{url}', [InstructorController::class, 'showByUrl'])->name('instructor.showUrl');
Route::get('/packs', [PackController::class, 'clientIndex'])->name('packs');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/experts', [InstructorController::class, 'clientIndex'])->name('instructors.index');
Route::get('/search', [CourseController::class, 'clientSearch'])->name('search');
Route::get('/services', [ServiceController::class, 'clientIndex'])->name('services');

require __DIR__.'/auth.php';
