@extends('layouts.app')
@section('content')


<form action="/permission-store/{{$role->id}}" method="post">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                    @php
                                    $roles = App\Models\User::getpermissionsByGroupName('Roles');
                                    $buscreate = App\Models\User::getpermissionsByGroupName('Add New-bus');
                                    $buses = App\Models\User::getpermissionsByGroupName('Bus Info');
                                    $routecreate = App\Models\User::getpermissionsByGroupName('Add New-route');
                                   $routes = App\Models\User::getpermissionsByGroupName('Route Info');
                                   $schedulecreate = App\Models\User::getpermissionsByGroupName('Add New-schedule');
                                   $schedules = App\Models\User::getpermissionsByGroupName('Schedules Info');
                                    $users= App\Models\User::getpermissionsByGroupName('Users');
                                     $reports = App\Models\User::getpermissionsByGroupName('Reports');
                                    @endphp
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">AssignPermission</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/roles" class="btn btn-sm btn-primary">Back to Roles&permissions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                <th>Module</th>
                                                            <th>Sub Module</th>
                                                            <th>Add</th>
                                                            <th>View</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                                        
                                                        <tr>
                                                            <td>Roles</td>
                                                            <td>All Roles</td>
                                                            @foreach ($roles as $permission)
                                                            <td>
                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>
                                                            </td>
                                                            @endforeach
<td></td>
                                                        </tr>
         

                                                        <tr>
                                                            <td>Bus Info</td>
                                                            <td>Add New</td>
                                                            <td>
                                                                @foreach ($buscreate as $permission)
                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>

                                                                @endforeach
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>Bus Info</td>

                                                            @foreach ($buses as $permission)
                                                            <td>
                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>
                                                            </td>
                                                            @endforeach

                                                        </tr>

                                                        </tr>
                                                        <!--END-->
                                                        <!--CLUB-->
                                                        <tr>
                                                            <td>Leagues</td>
                                                            <td>Add New</td>
                                                            <td>
                                                                @foreach ($routecreate  as $permission)
                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>

                                                                @endforeach
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>Route Info</td>
                                                            @foreach ($routes as $permission)
                                                            <td>
                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>
                                                            </td>
                                                            @endforeach


                                                        </tr>

                                                        </tr>
                                                        <!--END-->


<tr>
                                                            <td>Schedule Info</td>
                                                            <td>Add New</td>
                                                            <td>
                                                                @foreach ($schedulecreate as $permission)
                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>

                                                                @endforeach
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>Schedule Info</td>

                                                            @foreach ($schedules as $permission)
                                                            <td>
                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>
                                                            </td>
                                                            @endforeach
                                                        </tr>
                                                          

 <!--CLUB-->
                                            
                                                       
   <tr>
                                                            <td>Users</td>
                                                            <td>Users</td>
                                                            @foreach ($users as $permission)
                                                            <td>

                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>
                                                            </td>
                                                            @endforeach


                                                        </tr>
                                                         <tr>
                                                            <td>Reports</td>
                                                            <td>Reports</td>
                                                            <td></td>
                                                            @foreach ($reports as $permission)
                                                            <td>

                                                                <input type="checkbox" class="form-check-input" name="permission[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" {{$role->hasPermissionTo($permission)?'checked':''}}>
                                                            </td>
                                                            @endforeach

                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                      


                                                                                </tbody>
                        </table>

                        <button type="submit" style="float:right" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
</div>
</div>
</div>
                                </form>
                  
           
      
@endsection