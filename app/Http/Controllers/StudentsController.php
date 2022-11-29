<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index(){
        return view('students.index');
    }

    public function report(){
        return view('students.report');
    }

    public function create(){
        return view('students.create');
    }

    public function generatePDF()
    {
        $data = [
            'firstname' => 'phin ',
            'lastname' => 'anon',
            'address' => 'phnom penh',
            'address2'=>'st 314',
            'city'=>'phnom penh',
            'state'=>'boeung salang',
            'zip' =>'12345',
            'date' => date('m/d/Y')
        ];
        // return view('myPDF', $data);

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('myPDF.pdf');
    }
}
