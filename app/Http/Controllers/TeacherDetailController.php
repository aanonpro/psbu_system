<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\TeacherDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\FormTeacehrRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = TeacherDetail::query();
        // search with name and with name foreign keys
        if($request->search) {
            $u = Teacher::where('teacher_name_en', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
            $rows->where(function ($w) use ($u){     // use where function for call name from table user
                $w->whereIn('teacher_id', $u);
            });
            $rows->Orwhere('teacher_code', 'like', '%' .$request->search .'%')->Orwhere('phone', 'like', '%' . $request->search.'%')->get();

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

        $teachers_details = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();

        return view('teacher-detail.index',compact('teachers_details','status', 'counts','count_stt'));
    }

      // paginate with ajax request
      public function fetch_teachers_details(Request $request)
      {
          if($request->ajax())
          {
              $teachers_details = TeacherDetail::simplePaginate(6);
              return view('teacher-detail.table-paginate', compact('teachers_details'))->render();
          }
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::where('status','1')->get();
        $positions = Position::where('status','1')->get();
        return view('teacher-detail.form',compact('teachers','positions'));
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
       
        TeacherDetail::create($input);
        return redirect()->route('teachers-details.index')->with('message','Teacher details created ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherDetail  $teacherDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherDetail $teacherDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherDetail  $teacherDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherDetail $teachers_detail)
    {
        $teachers = Teacher::where('status','1')->get();
        $positions = Position::where('status','1')->get();
        return view('teacher-detail.form',compact('teachers_detail','teachers','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherDetail  $teacherDetail
     * @return \Illuminate\Http\Response
     */
    public function update(FormTeacehrRequest $request, TeacherDetail $teachers_detail)
    {
        $input = $request->all();
        // $input['updated_by'] = Auth::user()->id;
        $teachers_detail['updated_by'] = Auth::user()->id;


        if($request->hasfile('image')){

            $destination = 'uploads/teacher/'. $teachers_detail->image;
            if(File::exists($destination)){
                unlink($destination);
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file ->move('uploads/teacher', $filename);
            $input['image'] = $filename;
            $teachers_detail->update($input);
        }

        $teachers_detail->update($input);
        return redirect()->route('teachers-details.index')->with('message','teacherDetail updated ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherDetail  $teacherDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherDetail $teachers_detail)
    {
        if($teachers_detail){
            $destination = 'uploads/teacher/' . $teachers_detail->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $teachers_detail->delete();
            return redirect()->route('teachers-details.index')->with('message','teacherDetail deleted ');
        }else{
            return redirect()->route('teachers-details.index')->with('message','Teacher detail Not Found ');
        }
    }
}
