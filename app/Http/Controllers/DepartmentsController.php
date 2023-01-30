<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = Department::query();
        // search with name and with name foreign keys
        if($request->search) {
            $u = Faculty::where('name', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
            $rows->where(function ($w) use ($u){     // use where function for call name from table user
                $w->whereIn('faculty_id', $u);
            });
            $rows->Orwhere('name', 'like', '%' .$request->search .'%')->Orwhere('khmer', 'like', '%' . $request->search.'%')->get();
           
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

        $departments = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();     

        return view('department.index',compact('departments','status', 'counts','count_stt'));
    }

    // paginate with ajax request
    public function fetch_department(Request $request)
    {
        if($request->ajax())
        {
            $departments = Department::simplePaginate(6);
            return view('department.table-paginate', compact('departments'))->render();
        }
    }

    /**
     * route create
     
     */
    public function create()
    {
        $faculties = Faculty::where('status',1)->get();
        return view('department.form',\compact('faculties'));
    }

    /**
     * route store
     */
    public function store(Request $request)
    {
        $this->Validate($request, [
            'faculty_id' => 'required',
            'status' => 'required'
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        Department::create($input);
        return redirect()->route('departments.index')->with('message','Departments created ');
    }

    /**
     * route views
     */
    public function show($id)
    {
        $departments = Department::findByID($id);
        return view('department.view',compact('departments'));
    }

    /**
     * route edit
     */
    public function edit(Department $department)
    {
        $faculties = Faculty::where('status','1')->get();
        return view('department.form',compact('department','faculties'));
    }

    /**
     * route update
     */
    public function update(Request $request, Department $department)
    {
        $this->Validate($request, [
            'faculty_id' => 'required',
            'status' => 'required'
        ]);
        $department['updated_by'] = Auth::user()->id;
        $department->update($request->all());
        return redirect()->route('departments.index')->with('message','Departments updated ');
    }

    /**
     * routes delete 
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('message','Department deleted');
    }
}
