@extends('layouts.app', ['class' => 'register-page', 'page' => __('Register Page'), 'contentClass' => 'register-page'])

@section('content')
<div class="row">
    <div class="col-md-2 ml-auto">
    </div>
    <div class="col-md-8 mr-auto">
        <div class="card card-register card-white">
            <div class="card-header">
                <h4 class="card-title text-center" style="color:black;">Register</h4>
            </div>
            <form class="form" method="post" action="/register">
                @csrf

                <div class="card-body">
                    <div class="input-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-single-02"></i>
                            </div>
                        </div>
                        <input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="First Name" value="{{ old('first_name') }}">
                        @include('alerts.feedback', ['field' => 'first_name'])
                    </div>
                    <div class="input-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-single-02"></i>
                            </div>
                        </div>
                        <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="Last Name" value="{{ old('last_name') }}">
                        @include('alerts.feedback', ['field' => 'last_name'])
                    </div>
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"  name="role">
                        <option value="" selected>Select Role</option>
                            @foreach($roles as $role)
                            @if (old('role')==$role->name)
                        <option value="{{$role->name}}" selected>{{ $role->name }}</option>
                    @else
                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @include('alerts.feedback', ['field' => 'role'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}" value="{{ old('password_confirmation') }}">
                        @include('alerts.feedback', ['field' => 'password_confirmation'])

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-round btn-lg">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-2 ml-auto">
    </div>
</div>
@endsection