<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = Semester::query();
        //search name
          //search name
        if($request->search) {
            $rows->orWhere('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('khmer', 'LIKE', '%' . $request->search . '%')
            ->first();
        }

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

        $semesters = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('semester.index', compact('semesters','counts','count_stt', 'status'));
    }

     // paginate with ajax request
     public function fetch_semesters(Request $request)
     {
         if($request->ajax())
         {
             $semesters = Semester::simplePaginate(6);
             return view('semester.table-paginate', compact('semesters'))->render();
         }
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('semester.form');
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
        Semester::create($input);
        return redirect()->route('semesters.index')->with('message','Semester created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        return view('semester.form', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        $this->Validate($request, [
            'status' => 'required'
        ]);
        $semester['updated_by'] = Auth::user()->id;
        $semester->update($request->all());
        return redirect()->route('semesters.index')->with('message','Semester updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->back()->with('message','Semester updated');
    }
}
