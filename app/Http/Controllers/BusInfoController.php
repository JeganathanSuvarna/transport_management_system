<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $busInformations=Bus::all();
        return view('businfo.index',compact('busInformations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('businfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                 => 'required|max:255',
                'bus_no'              => 'required|unique:bus_infos',
                'capacity'              => 'required',

            ],
            [
                'name.required'                 => 'Bus Name is required',
                'bus_no.required'              => 'Bus Number is required',
                'bus_no.unique'              => 'Bus Number is alreday taken',
                'capacity.required'              => 'Capacity is required',


            ]
            

        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $busInfo=new Bus();
        $busInfo->name=$request->name;
        $busInfo->bus_no=$request->bus_no;
        $busInfo->capacity=$request->capacity;
        $busInfo->save();
        return redirect('/bus-info')->with('success', 'Bus Info created successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkSchedules($id)
    {
        $busInfo=Bus::find($id);
        $schedules=$busInfo->schedules;
        if(count($schedules)>=1){
            return response()->json(['has'=>'yes']);
        }
        else{
            return response()->json(['has'=>'no']);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $busInfo=Bus::find($id);
        return view('businfo.edit',compact('busInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                 => 'required|max:255',
                'bus_no'              => 'required',
                'capacity'              => 'required',

            ],
            [
                'name.required'                 => 'Bus Name is required',
                'bus_no.required'              => 'Bus Number is required',
                'capacity.required'              => 'Capacity is required',


            ]
            

        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $busInfo=Bus::find($id);
        $busInfo->name=$request->name;
        $busInfo->bus_no=$request->bus_no;
        $busInfo->capacity=$request->capacity;
        $busInfo->save();
        return redirect('/bus-info')->with('success', 'Bus Info updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bus=Bus::find($id);
        $bus->schedules()->delete();
        $bus->delete();
        return response()->json([
            'success'
        ]);
    }
}
