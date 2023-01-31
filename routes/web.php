<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MajorsController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\TeacherDetailController;

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
//
    Route::resource('departments', DepartmentsController::class);
    // paginate routes
    Route::post('departments/fetch_department', [DepartmentsController::class, 'fetch_department'])->name('departments.fetch_department');
//
    Route::get('faculties-export', [FacultyController::class,'export'])->name('faculty.export');
    Route::post('faculties-import', [FacultyController::class,'import'])->name('faculty.import');
//
    Route::resource('faculties', FacultyController::class);
    // paginate routes
    Route::post('faculties/fetch_data', [FacultyController::class, 'fetch_data'])->name('faculties.fetch_data');
//
    Route::resource('shifts', ShiftController::class);
    Route::post('shifts/fetch_shifts', [ShiftController::class, 'fetch_shifts'])->name('shifts.fetch_shifts');
//
    Route::resource('majors', MajorsController::class);
    Route::post('majors/fetch_majors', [MajorsController::class, 'fetch_majors'])->name('majors.fetch_majors');

    Route::resource('rooms', RoomController::class);
    Route::post('rooms/fetch_rooms', [RoomController::class, 'fetch_rooms'])->name('rooms.fetch_rooms');
//
    Route::resource('subjects', SubjectController::class);
    Route::post('subjects/fetch_subjects', [SubjectController::class, 'fetch_subjects'])->name('subjects.fetch_subjects');
//
    Route::resource('teachers', TeacherController::class);
    Route::post('teachers/fetch_teachers', [TeacherController::class, 'fetch_teachers'])->name('teachers.fetch_teachers');
//
    Route::resource('teachers-details', TeacherDetailController::class);
    Route::post('teachers-details/fetch_teachers_details', [TeacherDetailController::class, 'fetch_teachers_details'])->name('teachers-details.fetch_teachers_details');
//
    Route::resource('positions', PositionController::class);
    Route::post('positions/fetch_positions', [PositionController::class, 'fetch_positions'])->name('positions.fetch_positions');
//



    // route users
    route::get('profiles', [UsersController::class,'index']);



});
// route for normal users
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
