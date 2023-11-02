@extends('layouts.app')
@section('content')


@php
            $role_name=Auth::user()->getRoleNames()[0];
            $role=Spatie\Permission\Models\Role::where('name',$role_name)->first();
            @endphp
<div class="content m-4 p-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Schedules</h4>
                        </div>
                       
                    </div>
                </div>
                <div class="">
<div class="row m-4">
    <form method="post" action="/search">
        @csrf
        <div class="row">
        <div class="col-md-3"> 
        <select class="form-control"  name="bus_id">

            <option value="" selected>Select Bus</option>
                            @foreach($buses as $bus) 
                            @if (app('request')->input('bus_id')==$bus->id)
                            <option value="{{$bus->id}}" selected>{{$bus->name}}</option>

                            @else
                            <option value="{{$bus->id}}">{{$bus->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3"> 
                    <select class="form-control"  name="route_id">

                <option value="" selected>Select Route</option>
                            @foreach($routes as $route) 
                            @if (app('request')->input('route_id')==$route->id)
                        <option value="{{$route->id}}" selected>{{ $route->route_name }}</option>
                    @else
                            <option value="{{$route->id}}">{{$route->route_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3"> 
                    <input type="time" name="start_time" class="form-control" placeholder="Start Time" value="{{ app('request')->input('start_time') }}">

                    </div>
                    <div class="col-md-3"> 
                    <input type="time" name="end_time" class="form-control" placeholder="Start Time" value="{{ app('request')->input('end_time') }}">

                    </div>
                    <br>
                    <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>

                    </div>
                    <div class="col-md-2">
                    <a href="/reports"><button type="button" class="btn btn-secondary">Reset</button></a>

                    </div>
                    <div class="col-md-2">
                    <a href="/reports/download" target="_blank"><button type="button" class="btn btn-secondary">Download PDF</button></a>

                    </div>
                    </div>
                       
    </form>
    
</div>
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:1%">#</th>
                                    <th scope="col" style="width:20%">Bus Name</th>
                                    <th scope="col" style="width:20%">Route Name</th>
                                    <th scope="col" style="width:10%">Start Time</th>
                                    <th scope="col" style="width:10%">End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $key=>$schedule)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$schedule->bus->name}}
                                    </td>
                                    <td>
                                        {{$schedule->route->route_name}}
                                    </td>
                                    <td>
                                        {{$schedule->start_time}}
                                    </td>
                                    <td>
                                        {{$schedule->end_time}}
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
       
    </script>
    @endsection