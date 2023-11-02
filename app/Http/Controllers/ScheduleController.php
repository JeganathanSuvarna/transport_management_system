<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator; 
use PDF;
use Illuminate\Support\Facades\Session;
class ScheduleController extends Controller
{
    public function index()
    {
        $schedules=Schedule::with('bus','route')->get();
        return view('schedules.index',compact('schedules'));
    }

    public function reports()
    {
        $buses=Bus::all();
        $routes=Route::all();
        $schedules=Schedule::with('bus','route')->get();
        return view('schedules.reports',compact('schedules','buses','routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buses=Bus::all();
        $routes=Route::all();
        return view('schedules.create',compact('buses','routes'));
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
                'route_id'                 => 'required',
                'start_time'              => 'required',
                'end_time'              => 'required',
                'bus_id'              => 'required',


            ],
            [
                'route_id.required'                 => 'Please Select Route',
                'bus_id.required'              => 'Please Select Bus',
                'start_time.required'              => 'Please Select Start Time',
                'end_time.required'              => 'Please select end time',


            ]
            

        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $schedule=new Schedule();
        $schedule->route_id=$request->route_id;
        $schedule->bus_id=$request->bus_id;
        $schedule->start_time=$request->start_time;
        $schedule->end_time=$request->end_time;
        $schedule->save();
        return redirect('/schedules')->with('success', 'Schedule created successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $route_id=$request->input('route_id');
        $bus_id=$request->input('bus_id');
        $start_time=$request->input('start_time');
        $end_time= $request->input('end_time');
        $query = Schedule::query();

        if ($route_id) {
            $query->where('route_id', $route_id);
        }

        if ($bus_id) {
            $query->where('bus_id', $bus_id);
        }

        if ($start_time) {
            $query->where('start_time', $start_time);
        }
        if ($end_time) {
            $query->where('end_time', $end_time);
        }
        $schedules = $query->with('bus','route')->get();
        Session::put('schedules',$schedules);
                    $buses=Bus::all();
                    $routes=Route::all();
                    return view('schedules.reports',compact('schedules','buses','routes','route_id','bus_id','start_time','end_time'));
        
    }
public function downloadPdf(){
  $schedules=session::get('schedules');
 $pdf = PDF::loadView('schedules.pdf', compact('schedules'))->setPaper('a4', 'landscape');
    return $pdf->stream('bus schedules.pdf');
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule=Schedule::find($id);
        $buses=Bus::all();
        $routes=Route::all();
        return view('schedules.edit',compact('schedule','buses','routes'));
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
            [
                'route_id'                 => 'required',
                'start_time'              => 'required',
                'end_time'              => 'required',
                'bus_id'              => 'required',


            ],
            [
                'route_id.required'                 => 'Please Select Route',
                'bus_id.required'              => 'Please Select Bus',
                'start_time.required'              => 'Please Select Start Time',
                'end_time.required'              => 'Please select end time',


            ]
            
            

        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $schedule=Schedule::find($id);
        $schedule->route_id=$request->route_id;
        $schedule->bus_id=$request->bus_id;
        $schedule->start_time=$request->start_time;
        $schedule->end_time=$request->end_time;
        $schedule->save();
        return redirect('/schedules')->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule=Schedule::find($id);
        $schedule->delete();
        return response()->json(['schedule is deleted successfully']);
    }
}
