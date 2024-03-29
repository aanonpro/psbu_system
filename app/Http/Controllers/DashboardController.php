<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Faculty;
// use KhmerDateTime\KhmerDateTime;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // date_default_timezone_set('Asia/Bangkok');
        // $ldate = date('Y-m-d H:i:s');
        // return $ldate;
        $department = Department::count();
        $count = Faculty::count();
        $teacher = Teacher::count();
        $student = Student::count();
        return view('index', compact('count','department','teacher','student'));
    }
}
