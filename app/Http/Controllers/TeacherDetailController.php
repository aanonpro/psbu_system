<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\TeacherDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\FormTeacehrRequest;
use Symfony\Component\Console\Input\Input;
use Illuminate\Foundation\Http\FormRequest;

class TeacherDetailController extends Controller
{
    /**
     *index 
     */
    public function index(Request $request)
    {
        $rows = TeacherDetail::query();
        $positions = Position::all();
        // $pos_id = $positions->where('id');

        // ajaxy search dropdown
        if($request->ajax()){
            // $rows->select('*','teacher.teacher_name_en')->get();

            $teachers_details = $rows->where(['position_id'=>$request->position],)->get()->load('teacher','position');
          
            return response()->json(['teachers_details' => $teachers_details]);
        }

        // search with name and with name foreign keys
        if($request->search) {
            $t = Teacher::where('teacher_name_en', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
            $p = Position::where('name', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
            $rows->where(function ($w) use ($t){     // use where function for call name from table user
                $w->whereIn('teacher_id', $t);
            });

            $rows->Orwhere(function ($o) use ($p){
                $o->Orwhere('position_id', $p);
            });
           
            $rows->Orwhere('teacher_code', 'like', '%' .$request->search .'%')
                ->Orwhere('phone', 'like', '%' . $request->search.'%')
                ->Orwhere('address', 'like', '%' . $request->search.'%')
                ->get();
        }

        // search status with button selection
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

        //  search position with button selection
         if ($request->position == $positions) {
            $rows->where('position_id',Position::where('id'));
            $search_pos = $positions;
        }
        else {
            $search_pos = 'All positions';
        }


        $teachers_details = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();

        return view('teacher-detail.index',compact('teachers_details','positions','search_pos','status', 'counts','count_stt'));
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
     * create a new teacher
     */
    public function create()
    {
        $teachers = Teacher::where('status','1')->get();
        $positions = Position::where('status','1')->get();
        return view('teacher-detail.form',compact('teachers','positions'));
    }

    /**
     * store data
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
     * show information
     */
    public function show(TeacherDetail $teacherDetail)
    {
        //
    }

    /**
     * edit information
     */
    public function edit(TeacherDetail $teachers_detail)
    {
        $teachers = Teacher::where('status','1')->get();
        $positions = Position::where('status','1')->get();
        return view('teacher-detail.form',compact('teachers_detail','teachers','positions'));
    }

    /**
     * Update the specified resource in storage.
     
     */
    public function update(FormTeacehrRequest $request, TeacherDetail $teachers_detail)
    {
        $input = $request->all();
        // $input['updated_by'] = Auth::user()->id;
        $teachers_detail['updated_by'] = Auth::user()->id;

        if($request->hasfile('image')){

            $destination = 'uploads/teacher/'. $teachers_detail->image;
            if(File::exists($destination)){
                File::delete($destination);
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
