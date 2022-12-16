<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
// use KhmerDateTime\KhmerDateTime;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // $dateTime = date('Y-m-d H:i:s')->timezone_location_get();
        // return $dateTime;
        $count = Faculty::count();
        return view('index', \compact('count'));
    }
}
