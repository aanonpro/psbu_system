<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = Room::query();
        
        // search name 
        $rows->where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $query->orWhere('name', 'LIKE', '%' . $s . '%')
                        ->orWhere('khmer', 'LIKE', '%' . $s . '%')
                        ->orWhere('number', 'LIKE', '%' . $s . '%')
                        ->orWhere('floor', 'LIKE', '%' . $s . '%')
                        ->orWhere('chair', 'LIKE', '%' . $s . '%')
                        ->orWhere('table', 'LIKE', '%' . $s . '%')
                        ->orWhere('property', 'LIKE', '%' . $s . '%')
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
        
        $rooms = $rows->simplePaginate(6);
        $counts = $rows->count();
        $count_stt = $rows->where('status','1')->count();
        return view('rooms.index', compact('rooms','counts','count_stt', 'status'));
    }
     // paginate with ajax request
     public function fetch_rooms(Request $request)
     {
         if($request->ajax())
         {
             $rooms = Room::simplePaginate(6);
             return view('rooms.table-paginate', compact('rooms'))->render();
         }
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->Validate($request, [
                'status' => 'required'
            ]);
            $input = $request->all();
            $input['created_by'] = Auth::user()->id;
            Room::create($input);
           
        }catch(Exception $e){
            return back()->withError($e->getMessage())->withInput();
        }
        return redirect()->route('rooms.index')->with('message','Rooms created');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('rooms.form', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $this->Validate($request, [
            'status' => 'required'
        ]);
        $room['updated_by'] = Auth::user()->id;
        $room->update($request->all());
        return redirect()->route('rooms.index')->with('message','Room updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back()->with('message','Room deleted');
    }
}
