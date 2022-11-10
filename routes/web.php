<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\View\View;

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
});
// route for normal users
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);