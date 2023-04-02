<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Shift;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $degrees = Degree::all();
        $shifts = Shift::all();

         // search name
        if($request->search){
            // $p = Position::where('name', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
            $rows->where('stu_name', 'LIKE', '%' .$request->search. '%')
                ->orWhere('stu_id', 'LIKE', '%' . $request->search. '%')
                ->orWhere('stu_name_latin', 'LIKE', '%' . $request->search. '%')
                ->orWhere('stu_address', 'LIKE', '%' . $request->search. '%')
                ->orWhere('stu_phone', 'LIKE', '%' . $request->search. '%')
                ->first();
            // $rows->Orwhere(function ($o) use ($p){
            //     $o->Orwhere('position_id', $p);
            // });
        }

        //  ajaxy search dropdown
        if($request->ajax()){
            $students = $rows->where(['degrees_id'=>$request->degree],['shift_id'=>$request->shift])->get()->load('degree','shift');
            return response()->json(['students' => $students]);
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

        $students = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('student.index', compact('students','status','counts','count_stt','degrees','shifts'));
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
    public function store(StudentRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $input['stu_id'] = $this->getStudentID();

        // if($request->hasfile('image')){
        //     $file = $request->file('image');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file ->move('uploads/student', $filename);
        //     $input['image'] = $filename;
        // }

        Student::create($input);
        return redirect()->route('students.index')->with('message','students created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('student.view',compact('student'));

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
    public function update(StudentRequest $request, Student $student)
    {
        $input = $request->all();
        $teacher['updated_by'] = Auth::user()->id;

        // if($request->hasfile('image')){

        //     $destination = 'uploads/teacher/'. $teacher->image;
        //     if(File::exists($destination)){
        //         File::delete($destination);
        //     }

        //     $file = $request->file('image');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file ->move('uploads/teacher', $filename);
        //     $input['image'] = $filename;
        //     $teacher->update($input);
        // }

        $student->update($input);
        return redirect()->route('students.index')->with('message','Student updated');
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
        // $batch = Batch::latest()->first();
        // $year = date('Y');
        return  'PSBUSID-'. str_pad($id, 4, '0', STR_PAD_LEFT);
    }
}
