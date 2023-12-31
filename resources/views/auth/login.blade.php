@extends('layouts.app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page'])

@section('content')

    <div class="col-md-10 text-center ml-auto mr-auto">
    </div>
    <div class="col-lg-6 col-md-8 ml-auto mr-auto">
        
        <form class="form" method="post" action="/login">
            @csrf

            <div class="card card-login card-white">
                <div class="card-header">
                    <h1 class="card-title text-center mt-4">Login</h1>
                </div>
                @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                <div class="card-body">
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ __('Password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit"  class="btn btn-primary btn-lg btn-block mb-3">Login</button>
                    
                        <a href="/signup"><button type="button"   class="btn btn-primary btn-lg btn-block mb-3">Register New User</button></a>
                     
                    
                </div>
            </div>
        </form>
    </div>
@endsection
