<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Shift;
use App\Models\Majors;
use App\Models\Session;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Academic;
use App\Models\Schedule;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows=Schedule::query();
        $departments = Department::all();
         // search name
        if($request->search){
            $p = Department::where('name', 'like', '%' . $request->search . '%')->select('id')->take(4)->pluck('id')->toArray();
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

        $schedules = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('schedule.index', compact('schedules','departments','status','counts','count_stt'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $majors = Majors::all();
        $academics = Academic::all();
        $semesters = Semester::all();
        $shifts = Shift::all();
        $teachers = Teacher::all();
        $sessions = Session::all();
        $rooms = Room::all();
        $subjects = Subject::all();

        return view('schedule.form', compact('teachers', 'rooms', 'subjects','departments','academics','semesters','shifts','sessions','majors'));
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
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
