@extends('layouts.app')
@section('content')

@php
            $role_name=Auth::user()->getRoleNames()[0];
            $role=Spatie\Permission\Models\Role::where('name',$role_name)->first();
            @endphp
<div class="content m-4 p-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Users</h4>
                        </div>
                        <div class="col-4 text-right">
                        @if($role->hasPermissionTo('Create-user'))

                            <a href="/users/create" class="btn btn-sm btn-primary">Add User</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:1%">#</th>
                                    <th scope="col" style="width:20%">First Name</th>
                                    <th scope="col" style="width:20%">Last Name</th>
                                    <th scope="col" style="width:20%">Email</th>
                                    <th scope="col" style="width:10%">Role</th>
                                    <th scope="col" style="width:49%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key=>$user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$user->first_name}}
                                    </td>
                                    <td>
                                        {{$user->last_name}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>{{$user->getRoleNames()[0]}}</td>
                                    <td>
                                    @if($role->hasPermissionTo('Edit-user'))

                                        <a href="/users/{{$user->id}}/edit"><button type="button" class="btn btn-warning">Edit</button></a>
                                       @endif
                                       @if($role->hasPermissionTo('Delete-user'))
                                       @if(!($user->getRoleNames()[0]=='SuperAdmin'))
                                        <form action="/users/{{$user->id}}" method="post">
                                            @csrf
                                            @method('delete')
                                       <button type="submit" class="btn btn-primary">Delete</button>
</form>
@endif
                                        @endif

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
    @endsection