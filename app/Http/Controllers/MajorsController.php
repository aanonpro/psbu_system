<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $counts = Majors::count();
        $majors = Majors::all();
        return view('majors.index', compact('majors','counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = Faculty::where('status',1)->get();
        return view('majors.form',compact('faculties'));
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
            'faculty_id' => 'required',
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
        $faculties = Faculty::where('status','1')->get();
        return view('majors.form',compact('major','faculties'));
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
