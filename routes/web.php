<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
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
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\ServiceRequestController;

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
    Route::redirect('/admin', '/admin/dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::get('/admin/about', [AboutController::class, 'edit'])->name('admin.about.edit');
    Route::put('/admin/about/{about}', [AboutController::class, 'update'])->name('admin.about.update');
    Route::get('/admin/static-pages', [StaticPageController::class, 'index'])->name('admin.static-pages.index');
    Route::get('/admin/static-pages/{page}/edit', [StaticPageController::class, 'edit'])->name('admin.static-pages.edit');
    Route::put('/admin/static-pages/{page}', [StaticPageController::class, 'update'])->name('admin.static-pages.update');

    // Admin fields routes
    Route::get('/admin/field/create', [FieldController::class, 'create'])->name('field.create');
    Route::post('/admin/field', [FieldController::class, 'store'])->name('field.store');
    Route::get('/admin/fields', [FieldController::class, 'index'])->name('admin.fields');
    Route::get('/admin/field/edit/{field}', [FieldController::class, 'edit'])->name('field.edit');
    Route::put('/admin/field/{field}', [FieldController::class, 'update'])->name('field.update');

    //Admin instructor routes
    Route::get('/admin/instructor/create', [InstructorController::class, 'create'])->name('instructor.create');
    Route::post('/admin/instructor', [InstructorController::class, 'store'])->name('instructor.store');
    Route::get('/admin/instructors', [InstructorController::class, 'index'])->name('admin.instructors');
    Route::get('/admin/instructor/edit/{instructor}', [InstructorController::class, 'edit'])->name('admin.instructor.edit');
    Route::put('/admin/instructor/{instructor}', [InstructorController::class, 'update'])->name('admin.instructor.update');
    Route::post('/admin/instructors/reorder', [InstructorController::class, 'reorder'])->name('admin.instructor.reorder');
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
    Route::get('/admin/service/{service}', [ServiceController::class, 'show'])->name('admin.service.show');
    Route::get('/admin/service/edit/{service}', [ServiceController::class, 'edit'])->name('admin.service.edit');
    Route::put('/admin/service/{service}', [ServiceController::class, 'update'])->name('admin.service.update');
    Route::delete('/admin/service/{service}', [ServiceController::class, 'delete'])->name('admin.service.delete');
    Route::get('/admin/service-requests', [ServiceRequestController::class, 'index'])->name('admin.service-requests.index');
    Route::get('/admin/service-request/{serviceRequest}', [ServiceRequestController::class, 'show'])->name('admin.service-requests.show');

    // Admin partners routes
    Route::get('/admin/partner/create', [PartnerController::class, 'create'])->name('admin.partner.create');
    Route::post('/admin/partner', [PartnerController::class, 'store'])->name('admin.partner.store');
    Route::get('/admin/partners', [PartnerController::class, 'index'])->name('admin.partners');
    Route::get('/admin/partner/edit/{partner}', [PartnerController::class, 'edit'])->name('admin.partner.edit');
    Route::put('/admin/partner/{partner}', [PartnerController::class, 'update'])->name('admin.partner.update');
    Route::delete('/admin/partner/{partner}', [PartnerController::class, 'destroy'])->name('admin.partner.delete');
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/checkout/{course}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/lesson/addView', [LessonController::class, 'addView'])->name('lesson.addview');
    Route::post('/lesson/updateTime', [LessonController::class, 'updateTime'])->name('lesson.updateTime');
    Route::post('/request/store', [CourseRequestController::class, 'store'])->name('request.store');
    Route::get('/requests', [CourseRequestController::class, 'index'])->name('requests');
    Route::post('/offer/store', [OfferController::class, 'store'])->name('offer.store');
    Route::get('/offers', [OfferController::class, 'index'])->name('offers');
    Route::get('/course/payment/{id}', [CourseController::class, 'preparePayment'])->name('course.payment');
    Route::get('/course/save/{id}', [CourseController::class, 'saveCourse'])->name('course.save');
});

Route::post('/service-request', [ServiceRequestController::class, 'store'])->name('service-request.store');

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
Route::get('/service/{url}', [ServiceController::class, 'showByUrl'])->name('service.showUrl');
Route::get('/terms-of-use', [StaticPageController::class, 'show'])->defaults('slug', 'terms-of-use')->name('terms-of-use');
Route::get('/privacy-policy', [StaticPageController::class, 'show'])->defaults('slug', 'privacy-policy')->name('privacy-policy');
Route::get('/help-center', [StaticPageController::class, 'show'])->defaults('slug', 'help-center')->name('help-center');
Route::get('/pages/{slug}', [StaticPageController::class, 'show'])->name('static-pages.show');

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__.'/auth.php';
