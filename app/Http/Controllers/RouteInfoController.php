<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
class RouteInfoController extends Controller
{
    public function index()
    {
        $routeInformations=Route::all();
        return view('routeinfo.index',compact('routeInformations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('routeinfo.create');
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
                'start_point'              => 'required',
                'end_point'              => 'required',
                'distance'              => 'required',


            ],
            [
                'name.required'                 => 'Route Name is required',
                'start_point.required'              => 'Start Point is required',
                'end_point.required'              => 'End point is required',
                'distance.required'              => 'Distance is required',


            ]
            

        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $routeInfo=new Route();
        $routeInfo->route_name=$request->name;
        $routeInfo->start_point=$request->start_point;
        $routeInfo->end_point=$request->end_point;
        $routeInfo->distance=$request->distance;
        $routeInfo->save();
        return redirect('/route-info')->with('success', 'Route Info created successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routeInfo=Route::find($id);
        return view('routeinfo.edit',compact('routeInfo'));
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
                'start_point'              => 'required',
                'end_point'              => 'required',
                'distance'              => 'required',


            ],
            [
                'name.required'                 => 'Route Name is required',
                'start_point.required'              => 'Start Point is required',
                'end_point.required'              => 'End point is required',
                'distance.required'              => 'Distance is required',


            ]
            

        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $routeInfo=Route::find($id);
        $routeInfo->route_name=$request->name;
        $routeInfo->start_point=$request->start_point;
        $routeInfo->end_point=$request->end_point;
        $routeInfo->distance=$request->distance;
        $routeInfo->save();
        return redirect('/route-info')->with('success', 'Route Info updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route=Route::find($id);
        $route->schedules()->delete();
        $route->delete();
        return response()->json([
            'success'
        ]);
    }

    public function checkSchedules($id)
    {
        $routeInfo=Route::find($id);
        $schedules=$routeInfo->schedules;
        if(count($schedules)>=1){
            return response()->json(['has'=>'yes']);
        }
        else{
            return response()->json(['has'=>'no']);

        }
    }
}
