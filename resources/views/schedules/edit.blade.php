@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row m-4 p-4">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="card-title" style="color:black">Edit Schedule</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/schedules" class="btn btn-sm btn-primary">Back to Schedules</a>
                        </div>
                    </div>
                </div>
                <form method="post" action="/schedules/{{$schedule->id}}" autocomplete="off">
                    <div class="card-body">
                    @csrf
                            @method('put')
                            @include('alerts.success')

                            
                    <div class="input-group{{ $errors->has('bus_id') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <select class="form-control{{ $errors->has('bus_id') ? ' is-invalid' : '' }}"  name="bus_id">
                        <option value="" selected>Select Bus</option>
                            @foreach($buses as $bus)
                            @if ($schedule->bus_id==$bus->id)
                        <option value="{{$bus->id}}" selected>{{ $bus->name }}</option>
                    @else
                            <option value="{{$bus->id}}">{{$bus->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @include('alerts.feedback', ['field' => 'bus_id'])
                    </div>

                    <div class="input-group{{ $errors->has('bus_id') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <select class="form-control{{ $errors->has('route_id') ? ' is-invalid' : '' }}"  name="route_id">
                        <option value="" selected>Select Bus</option>
                            @foreach($routes as $route)
                            @if ($schedule->route_id==$route->id)
                        <option value="{{$route->id}}" selected>{{ $route->route_name }}</option>
                    @else
                            <option value="{{$route->id}}">{{$route->route_name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @include('alerts.feedback', ['field' => 'route_id'])
                    </div>


                            <div class="form-group{{ $errors->has('start_time') ? ' has-danger' : '' }}">
                                <label>Start Time</label>
                                <input type="time" name="start_time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" placeholder="Start Time" value="{{ $schedule->start_time }}">
                                @include('alerts.feedback', ['field' => 'start_time'])
                            </div>
                            <div class="form-group{{ $errors->has('end_time') ? ' has-danger' : '' }}">
                                <label>End Time</label>
                                <input type="time" name="end_time"  class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" placeholder="End Time" value="{{ $schedule->end_time}}">
                                @include('alerts.feedback', ['field' => 'end_time'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>

          
        </div>
        
    </div>
@endsection
