<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = Academic::query();
        // search name
        $rows->where([
            ['year', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $query->orWhere('year', 'LIKE', '%' . $s . '%')
                        ->orWhere('khmer', 'LIKE', '%' . $s . '%')
                        ->first();
                }
            }]
        ]);

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

        $academics = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('academic.index', compact('academics','counts','count_stt', 'status'));
    }
    // paginate with ajax request
    public function fetch_academics(Request $request)
    {
        if($request->ajax())
        {
            $academics = Academic::simplePaginate(6);
            return view('academic.table-paginate', compact('academics'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic.form');
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
            'status' => 'required'
        ]);
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        Academic::create($input);
        return redirect()->route('academics.index')->with('message','Academic created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function show(Academic $academic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function edit(Academic $academic)
    {
        return view('academic.form', compact('academic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Academic $academic)
    {
        $this->Validate($request, [
            'status' => 'required'
        ]);
        $academic['updated_by'] = Auth::user()->id;
        $academic->update($request->all());
        return redirect()->route('academics.index')->with('message','Academic updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academic $academic)
    {
        $academic->delete();
        return redirect()->back()->with('message','Academic updated');        
    }
}
