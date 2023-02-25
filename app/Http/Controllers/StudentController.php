<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Shift;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows=Student::query();
        // $positions = Position::all();
         // search name
        if($request->search){
            // $p = Position::where('name', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
            $rows->orWhere('name_en', 'LIKE', '%' .$request->search. '%')
                ->orWhere('name_kh', 'LIKE', '%' . $request->search. '%')
                ->orWhere('address', 'LIKE', '%' . $request->search. '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search. '%')
                ->orWhere('email', 'LIKE', '%' . $request->search. '%')
                ->orWhere('code', 'LIKE', '%' . $request->search. '%')
                ->first();
            // $rows->Orwhere(function ($o) use ($p){
            //     $o->Orwhere('position_id', $p);
            // });
        }

         // ajaxy search dropdown
        // if($request->ajax()){
        //     $teachers = $rows->where(['position_id'=>$request->position],)->get()->load('position');          
        //     return response()->json(['teachers' => $teachers]);
        // }
         
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

        $students = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('student.index', compact('students','status','counts','count_stt'));
    }

    // paginate with ajax request
    public function fetch_students(Request $request)
    {
        if($request->ajax())
        {
            $students = Student::simplePaginate(6);
            return view('student.table-paginate', compact('students'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = $this->getStudentID();
        $degrees = Degree::all();
        $shifts = Shift::all();
        $batchs = Batch::all();
        return view('student.create',compact('degrees','shifts','batchs','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $degrees = Degree::all();
        $shifts = Shift::all();
        $batchs = Batch::all();
        $id = $student->stu_id;
        return view('student.create',compact('student','degrees','shifts','batchs','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    private function getStudentID()
    {
        $id = Student::max('id') + 1;
        $batch = Batch::latest()->first();
        $year = date('Y');
        return  'PSBU'.$year .$batch->batch_number. str_pad($id, 4, '0', STR_PAD_LEFT);
    }
}
