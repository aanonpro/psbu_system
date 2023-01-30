<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Majors;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MajorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = Majors::query();
        // search with name and with name foreign keys
        if($request->search) {
            $u = Department::where('name', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
            $rows->where(function ($w) use ($u){     // use where function for call name from table user
                $w->whereIn('department_id', $u);
            });
            $rows->Orwhere('name', 'like', '%' .$request->search .'%')
            ->Orwhere('name_latin', 'like', '%' . $request->search.'%')
            ->Orwhere('code', 'like', '%' . $request->search.'%')->get();
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

        $majors = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();    
        return view('majors.index', compact('majors','status','count_stt','counts'));
    }

    // paginate with ajax request
    public function fetch_majors(Request $request)
    {
        if($request->ajax())
        {
            $majors = Majors::simplePaginate(6);
            return view('majors.table-paginate', compact('majors'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status',1)->get();
        return view('majors.form',compact('departments'));
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
            'department_id' => 'required',
            'status' => 'required'
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        Majors::create($input);
        return redirect()->route('majors.index')->with('message','Majors created ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Majors  $majors
     * @return \Illuminate\Http\Response
     */
    public function show(Majors $majors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Majors  $majors
     * @return \Illuminate\Http\Response
     */
    public function edit(Majors $major)
    {
        $departments = Department::where('status','1')->get();
        return view('majors.form',compact('major','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Majors  $majors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Majors $major)
    {
        $this->Validate($request, [
            'faculty_id' => 'required',
            'status' => 'required'
        ]);
        $major['updated_by'] = Auth::user()->id;
        $major->update($request->all());
        return redirect()->route('majors.index')->with('message','Message updated ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Majors  $majors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Majors $major)
    {
        $major->delete();
        return redirect()->route('majors.index')->with('message','Majors deleted');
    }
}
