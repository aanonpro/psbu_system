<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\StudentsController;
use App\Http\Controllers\DashboardController;
// Route::get('/', [DashboardController::class, 'index']);


Auth::routes();

// redirect to login page
Route::get('/', function() {
    return redirect('/login');
});
// check login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// check middleware
Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'index']);

    //route students
    Route::get('students', [App\Http\Controllers\StudentsController::class, 'index']);
    Route::get('students/reports', [App\Http\Controllers\StudentsController::class, 'report']);
    Route::get('students/create', [App\Http\Controllers\StudentsController::class, 'create']);

});
// route for normal users
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
