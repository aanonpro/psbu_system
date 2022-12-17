<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Faculty;
// use KhmerDateTime\KhmerDateTime;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $department = Department::count();
        $count = Faculty::count();
        return view('index', \compact('count','department'));
    }
}
