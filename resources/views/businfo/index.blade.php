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
                            <h4 class="card-title">Bus Informations</h4>
                        </div>
                        <div class="col-4 text-right">
                        @if($role->hasPermissionTo('Create-busdata'))

                            <a href="/bus-info/create" class="btn btn-sm btn-primary">Add Bus Info</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:10%">#</th>
                                    <th scope="col" style="width:20%">Bus Name</th>
                                    <th scope="col" style="width:20%">Bus Number</th>
                                    <th scope="col" style="width:20%">Capacity</th>
                                    <th scope="col" style="width:30%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($busInformations as $key=>$busInfo)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$busInfo->name}}
                                    </td>
                                    <td>
                                        {{$busInfo->bus_no}}
                                    </td>
                                    <td>
                                        {{$busInfo->capacity}}
                                    </td>
                                    <td>
                                    @if($role->hasPermissionTo('Edit-busdata'))

                                        <a href="/bus-info/{{$busInfo->id}}/edit"><button type="button" class="btn btn-warning">Edit</button></a>
                                       @endif
                                       @if($role->hasPermissionTo('Delete-busdata'))

                                        <button type="button" class="btn btn-primary delete" data-id="{{$busInfo->id}}">Delete</button>
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
            This Bus Info has Schedules. If you delete, all the schedules associated with the bus will delete. are you ok with that?
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
            var bus_id=$(this).data('id');
            $.ajax({
                    type: 'GET',
                    url: '/bus-info/checkschedules/'+bus_id ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if(response.has=='yes'){
                            $("#checkSchedules").show();
                            $(".bus_delete_id").val(bus_id);
                        }
                        else{

                            $.ajax({
                    type: 'DELETE',
                    url: '/bus-info/'+bus_id ,
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
                    url: '/bus-info/'+id ,
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