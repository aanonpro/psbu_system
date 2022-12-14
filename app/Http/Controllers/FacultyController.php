<?php

namespace App\Http\Controllers;

use App\Models\faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty.create');
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
            'name' => 'required',
            'khmer' => 'required'
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        Faculty::create($input);

        return redirect()->route('faculties.index')->with('message','Faculties created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, faculty $faculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(faculty $faculty)
    {
        //
    }
}
