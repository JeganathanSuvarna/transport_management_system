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
                            <h4 class="card-title">Route Informations</h4>
                        </div>
                        <div class="col-4 text-right">
                        @if($role->hasPermissionTo('Create-routedata'))

                            <a href="/route-info/create" class="btn btn-sm btn-primary">Add Route Info</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class="">
                                <tr>
                                    <th scope="col" style="width:1%">#</th>
                                    <th scope="col" style="width:20%">Route Name</th>
                                    <th scope="col" style="width:20%">Starting Point</th>
                                    <th scope="col" style="width:20%">End Point</th>
                                    <th scope="col" style="width:10%">Distance</th>
                                    <th scope="col" style="width:30%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($routeInformations as $key=>$routeInfo)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$routeInfo->route_name}}
                                    </td>
                                    <td>
                                        {{$routeInfo->start_point}}
                                    </td>
                                    <td>
                                        {{$routeInfo->end_point}}
                                    </td>
                                    <td>
                                        {{$routeInfo->distance}}
                                    </td>
                                    <td>
                                    @if($role->hasPermissionTo('Edit-busdata'))

                                        <a href="/route-info/{{$routeInfo->id}}/edit"><button type="button" class="btn btn-warning">Edit</button></a>
                                       @endif
                                       @if($role->hasPermissionTo('Delete-busdata'))

                                        <button type="button" class="btn btn-primary delete" data-id="{{$routeInfo->id}}">Delete</button>
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
    
    
    <div class="modal" tabindex="-1" id="checkSchedules">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title heading"></h3>
      </div>
      <div class="modal-body">
          <div class="mb-3">
            This Route Info has Schedules. If you delete, all the schedules associated with the route will delete. are you ok with that?
          <input type="hidden" class="form-control bus_delete_id">


          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary noCancel" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="yesDelete">Delete</button>
      </div>
    </div>
  </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      $(document).ready(function() {
          $('.delete').on('click',function(){
            var route_id=$(this).data('id');
            $.ajax({
                    type: 'GET',
                    url: '/route-info/checkschedules/'+route_id ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if(response.has=='yes'){
                            $("#checkSchedules").show();
                            $(".bus_delete_id").val(route_id);
                        }
                        else{

                            $.ajax({
                    type: 'DELETE',
                    url: '/route-info/'+route_id ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {                      
                        location.reload();    
                    }
                });

                        }
                       
                    }
                });
          })
           
          $('#yesDelete').on('click',function(){
            var id=$(".bus_delete_id").val();
                $.ajax({
                    type: 'DELETE',
                    url: '/route-info/'+id ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {                      
                        location.reload();    
                    }
                });
          })

          $(".noCancel").on('click',function(){
            $("#checkSchedules").hide();
          })
         
        })
    </script>
    @endsection