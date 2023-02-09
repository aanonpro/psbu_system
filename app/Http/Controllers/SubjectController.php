<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use App\Models\Majors;
use App\Models\faculty;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows=Subject::query();
        // search name
        if($request->search){
    
            $rows->orWhere('title_en', 'LIKE', '%' . $request->search . '%')
                ->orWhere('title_kh', 'LIKE', '%' . $request->search . '%')
                ->orWhere('shortcut', 'LIKE', '%' .$request->search. '%')
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

        $subjects = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('subject.index', compact('subjects','status','counts','count_stt'));
    }

     // paginate with ajax request
     public function fetch_subjects(Request $request)
     {
         if($request->ajax())
         {
             $subjects = Subject::simplePaginate(6);
             return view('subject.table-paginate', compact('subjects'))->render();
         }
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = faculty::all();
        $departments = Department::all();
        $majors = Majors::all();
        $semesters= Semester::all();
        $academics = Academic::all();
        return view('subject.form',compact('faculties', 'departments', 'majors','semesters','academics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $faculty_id = $request->faculty_id;
        $department_id = $request->department_id;
        $major_id = $request->major_id;
        $semester_id = $request->semester_id;
        $academic_id = $request->academic_id;
        $title_en = $request->title_en;
        $title_kh = $request->title_kh;
        $credit = $request->credit;
        $shortcut = $request->shortcut;
        $noted = $request->noted;
        $status = $request->status;

        for($i=0; $i < count($title_en); $i++){
            $input = [
                'faculty_id' => $faculty_id,
                'department_id' => $department_id,
                'major_id' => $major_id,
                'semester_id' => $semester_id,
                'academic_id' => $academic_id,
                'title_en' => $title_en[$i],
                'title_kh' => $title_kh[$i],
                'credit' => $credit[$i],
                'shortcut' => $shortcut[$i],
                'noted' => $noted[$i],
                'status' => $status[$i],
            ];
            $input['created_by'] = Auth::user()->id;
            Subject::create($input);
        }
        return redirect()->route('subjects.index')->with('message','Subject created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subject.form',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $this->Validate($request, [
            'status' => 'required'
        ]);
        $subject['updated_by'] = Auth::user()->id;
        $subject->update($request->all());
        return redirect()->route('subjects.index')->with('message','Subjects updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('message','Subject deleted');
    }
}
