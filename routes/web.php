<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Teacher\AttendanceController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Admin
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('classes', ClassController::class);
    });

    // Teacher
    Route::middleware('can:teacher')->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('attendance/{class}', [AttendanceController::class,'show'])->name('attendance.show');
        Route::post('attendance/{class}', [AttendanceController::class,'store'])->name('attendance.store');
    });

});

require __DIR__.'/auth.php';
