<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MajorsController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentsController;

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

    // route department
    Route::resource('departments', DepartmentController::class);

    //route students
    Route::get('students/lists', [App\Http\Controllers\StudentsController::class, 'index']);
    Route::get('students/reports', [App\Http\Controllers\StudentsController::class, 'report']);
    Route::get('students/create', [App\Http\Controllers\StudentsController::class, 'create']);

    // get pdf
    Route::get('generate-pdf', [App\Http\Controllers\StudentsController::class, 'generatePDF']);
    //route departments
    Route::resource('departments', DepartmentsController::class);
    Route::get('faculties-export', [FacultyController::class,'export'])->name('faculty.export');
    Route::post('faculties-import', [FacultyController::class,'import'])->name('faculty.import');
    Route::resource('faculties', FacultyController::class);
    Route::resource('shifts', ShiftController::class);
    Route::resource('majors', MajorsController::class);

    // route users
    route::get('profiles', [UsersController::class,'index']);



});
// route for normal users
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
