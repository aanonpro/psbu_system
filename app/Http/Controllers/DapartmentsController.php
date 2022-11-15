<?php

namespace App\Http\Controllers;

use App\Models\Dapartments;
use Illuminate\Http\Request;

class DapartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Dapartments  $dapartments
     * @return \Illuminate\Http\Response
     */
    public function show(Dapartments $dapartments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dapartments  $dapartments
     * @return \Illuminate\Http\Response
     */
    public function edit(Dapartments $dapartments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dapartments  $dapartments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dapartments $dapartments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dapartments  $dapartments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dapartments $dapartments)
    {
        //
    }
}
