<?php

namespace App\Http\Controllers;

use App\Models\faculty;
use Illuminate\Http\Request;
use App\Exports\FacultiesExport;
use App\Imports\FacultiesImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counts = Faculty::count();
        $faculties = Faculty::all();
        return view('faculty.index', compact('faculties','counts'));
    }

    public function export()
    {
        return Excel::download(new FacultiesExport, 'faculties.xlsx');
    }

    public function import()
    {
        // Excel::import(new FacultiesImport, $request->file('file')->store('files'));
        // return redirect()->back();
        Excel::import(new FacultiesImport,request()->file('file'));
        return back();
        // return Excel::download(new BookingExport($data),'booking-report.xlsx',ExcelExcel::XLSX);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Validate($request, [
            'name' => 'required',
            'khmer' => 'required'
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        Faculty::create($input);

        return redirect()->route('faculties.index')->with('message','Faculties created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(faculty $faculty)
    {
        return view('faculty.form', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, faculty $faculty)
    {
        $faculty['updated_by'] = Auth::user()->id;
        $faculty->update($request->all());
        return redirect()->route('faculties.index')->with('message','Faculty updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(faculty $faculty)
    {
        $faculty->delete();
        return redirect()->back()->with('message','Faculty updated');
    }
}
