@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row m-4 p-4">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="card-title">Edit {{$routeInfo->route_name}} 's Info</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/route-info" class="btn btn-sm btn-primary">Back to Route Info</a>
                        </div>
                    </div>
                </div>
                <form method="post" action="/route-info/{{$routeInfo->id}}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')
                            @include('alerts.success')
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>Route Name</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Route Name" value="{{ $routeInfo->route_name }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('start_point') ? ' has-danger' : '' }}">
                                <label>Start Point</label>
                                <input type="text" name="start_point" class="form-control{{ $errors->has('start_point') ? ' is-invalid' : '' }}" placeholder="Start Point" value="{{ $routeInfo->start_point }}">
                                @include('alerts.feedback', ['field' => 'start_point'])
                            </div>
                            <div class="form-group{{ $errors->has('end_point') ? ' has-danger' : '' }}">
                                <label>End Point</label>
                                <input type="text" name="end_point" class="form-control{{ $errors->has('end_point') ? ' is-invalid' : '' }}" placeholder="End Point" value="{{ $routeInfo->end_point }}">
                                @include('alerts.feedback', ['field' => 'end_point'])
                            </div>
                            <div class="form-group{{ $errors->has('distance') ? ' has-danger' : '' }}">
                                <label>Distance</label>
                                <input type="text" name="distance"  class="form-control{{ $errors->has('distance') ? ' is-invalid' : '' }}" placeholder="Distance" value="{{ $routeInfo->distance }}">
                                @include('alerts.feedback', ['field' => 'distance'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">Update</button>
                    </div>
                </form>
            </div>

          
        </div>
        
    </div>
@endsection
