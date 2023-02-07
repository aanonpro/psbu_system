<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = Session::query();
        //search name
          //search name
        if($request->search) {
            $rows->orWhere('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('khmer', 'LIKE', '%' . $request->search . '%')
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

        $sessions = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('session.index', compact('sessions','counts','count_stt', 'status'));
    }

    // paginate with ajax request
    public function fetch_sessions(Request $request)
    {
        if($request->ajax())
        {
            $sessions = Session::simplePaginate(6);
            return view('session.table-paginate', compact('sessions'))->render();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shifts = Shift::where('status',1)->get();
        return view('session.form',compact('shifts'));
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
            'shift_id' => 'required',
            'status' => 'required'
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        Session::create($input);
        return redirect()->route('sessions.index')->with('message','Session created ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        $shifts = Shift::where('status','1')->get();
        return view('session.form',compact('shifts','session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $this->Validate($request, [
            'shift_id' => 'required',
            'status' => 'required'
        ]);
        $session['updated_by'] = Auth::user()->id;
        $session->update($request->all());
        return redirect()->route('sessions.index')->with('message','Sessions updated ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return redirect()->route('sessions.index')->with('message','Session deleted');
    }
}
