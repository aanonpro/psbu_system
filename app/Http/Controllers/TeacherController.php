<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\FormTeacehrRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows=Teacher::query();
        $positions = Position::all();
         // search name
        if($request->search){
            $p = Position::where('name', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
            $rows->orWhere('name_en', 'LIKE', '%' .$request->search. '%')
                ->orWhere('name_kh', 'LIKE', '%' . $request->search. '%')
                ->orWhere('address', 'LIKE', '%' . $request->search. '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search. '%')
                ->orWhere('email', 'LIKE', '%' . $request->search. '%')
                ->orWhere('code', 'LIKE', '%' . $request->search. '%')
                ->first();
            $rows->Orwhere(function ($o) use ($p){
                $o->Orwhere('position_id', $p);
            });
        }

         // ajaxy search dropdown
        if($request->ajax()){
            $teachers = $rows->where(['position_id'=>$request->position],)->get()->load('position');          
            return response()->json(['teachers' => $teachers]);
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

        $teachers = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('teacher.index', compact('teachers','positions','status','counts','count_stt'));
    }

    // paginate with ajax request
    public function fetch_teachers(Request $request)
    {
        if($request->ajax())
        {
            $teachers = Teacher::simplePaginate(6);
            return view('teacher.table-paginate', compact('teachers'))->render();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::where('status','1')->get();
        return view('teacher.form',compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormTeacehrRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file ->move('uploads/teacher', $filename);
            $input['image'] = $filename;
        }

        Teacher::create($input);
        return redirect()->route('teachers.index')->with('message','Teacher created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        // $position = Position::all();
        return view('teacher.view',compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $positions = Position::where('status','1')->get();
        return view('teacher.form',compact('teacher','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(FormTeacehrRequest $request, Teacher $teacher)
    {
        $input = $request->all();
        $teacher['updated_by'] = Auth::user()->id;

        if($request->hasfile('image')){

            $destination = 'uploads/teacher/'. $teacher->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
           
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file ->move('uploads/teacher', $filename);
            $input['image'] = $filename;
            $teacher->update($input);
        }

        $teacher->update($input);
        return redirect()->route('teachers.index')->with('message','Teachers updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        if($teacher){
            $destination = 'uploads/teacher/' . $teacher->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $teacher->delete();
            return redirect()->route('teachers.index')->with('message','teacher deleted ');
        }else{
            return redirect()->route('teachers.index')->with('message','Teacher  Not Found ');
        }

        // $teacher->delete();
        // return redirect()->route('teachers.index')->with('message','Teacher deleted');
    }
}
