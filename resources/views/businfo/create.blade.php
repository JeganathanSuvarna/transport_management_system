@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row m-4 p-4">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="card-title">Add Bus Info</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/bus-info" class="btn btn-sm btn-primary">Back to Bus Info</a>
                        </div>
                    </div>
                </div>
                <form method="post" action="/bus-info" autocomplete="off">
                    <div class="card-body">
                            @csrf

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>Bus Name</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Bus Name" value="{{ old('name') }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('bus_no') ? ' has-danger' : '' }}">
                                <label>Bus Number</label>
                                <input type="text" name="bus_no" class="form-control{{ $errors->has('bus_no') ? ' is-invalid' : '' }}" placeholder="Bus Number" value="{{ old('bus_no') }}">
                                @include('alerts.feedback', ['field' => 'bus_no'])
                            </div>
                            <div class="form-group{{ $errors->has('capacity') ? ' has-danger' : '' }}">
                                <label>Capacity</label>
                                <input type="number" name="capacity" min="0" class="form-control{{ $errors->has('capacity') ? ' is-invalid' : '' }}" placeholder="Capacity" value="{{ old('capacity') }}">
                                @include('alerts.feedback', ['field' => 'capacity'])
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
