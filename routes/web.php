<?php

use App\Http\Controllers\Web\Backend\CMS\AboutUs\AboutUsController;
use App\Http\Controllers\Web\Backend\CMS\Category\CategoryController;
use App\Http\Controllers\Web\Backend\CMS\ContactUs\ContactUsController;
use App\Http\Controllers\Web\Backend\CMS\OnlineCourses\OnlineCoursesController;
use App\Http\Controllers\Web\Backend\CMS\Subscription\SubscriptionController;
use App\Http\Controllers\Web\Backend\CMS\TopCourse\TopCourseController;
use App\Http\Controllers\Web\Backend\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.layouts.dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('about-us', AboutUsController::class);
Route::resource('categories', CategoryController::class);
Route::resource('top-course', TopCourseController::class);
Route::resource('online-courses', OnlineCoursesController::class);
Route::resource('subscriptions', SubscriptionController::class);
Route::resource('contactus', ContactUsController::class);



require __DIR__.'/auth.php';
