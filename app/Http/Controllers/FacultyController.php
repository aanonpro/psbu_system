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
    public function index(Request $request)
    {
        $rows = faculty::query();
        
        // search name 
        $rows->where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $query->orWhere('name', 'LIKE', '%' . $s . '%')
                        ->orWhere('khmer', 'LIKE', '%' . $s . '%')
                        ->first();
                }
            }]
        ]);

         // search with button selection
        if ($request->status == 'active') {
            $rows->where('status',1);
            $status = 'Active';
        }
        elseif ($request->status == 'inactive') {
            $rows->where('status', 0);
            $status = 'Inactive';
        }
        else {
            $status = 'All Status';
        }        
        
        $faculties = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('faculty.index', compact('faculties','counts','count_stt', 'status'));
    }

     // paginate with ajax request
     public function fetch_data(Request $request)
     {
         if($request->ajax())
         {
             $faculties = Faculty::simplePaginate(6);
             return view('faculty.table-paginate', compact('faculties'))->render();
         }
     }

    public function export()
    {
        return Excel::download(new FacultiesExport, 'faculties.xlsx');
    }

    public function import()
    {
       $import_fac = Excel::import(new FacultiesImport,request()->file('file'));
       if($import_fac){
        return back()->with('message', 'faculties imported successfully');
       }
        return back()->with('message', 'import failed');
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
            'status' => 'required'
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
        $this->Validate($request, [
            'status' => 'required'
        ]);
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
