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
                        <div class="col-4 text-right">
                        @if($role->hasPermissionTo('Create-busdata'))

                            <a href="/schedules/create" class="btn btn-sm btn-primary">Add Schedule</a>
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
                                    <th scope="col" style="width:20%">Bus Name</th>
                                    <th scope="col" style="width:20%">Route Name</th>
                                    <th scope="col" style="width:10%">Start Time</th>
                                    <th scope="col" style="width:10%">End Time</th>
                                    <th scope="col" style="width:39%">Actions</th>
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
                                    <td>
                                    @if($role->hasPermissionTo('Edit-busdata'))

                                        <a href="/schedules/{{$schedule->id}}/edit"><button type="button" class="btn btn-warning">Edit</button></a>
                                       @endif
                                       @if($role->hasPermissionTo('Delete-busdata'))

                                        <button type="button" class="btn btn-primary delete" data-id="{{$schedule->id}}">Delete</button>
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
    <div class="modal" tabindex="-1" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Are you sure!</h3>
      </div>
      <div class="modal-body">
        <p>You want to Delete?</p>
      </div>
      <input type="hidden" name="schedule_id" class="schedule">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" style="padding:10px">Close</button>
        <button type="button" class="btn btn-primary deleteSuccess">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
          $('.delete').on('click',function(e){
            e.preventDefault();
            var schedule_id=$(this).data('id');
            $(".schedule").val(schedule_id);
            $('#deleteModal').show();
          })
           $('.deleteSuccess').on('click',function(){
            var id=$(".schedule").val();
            $.ajax({
                    type: 'DELETE',
                    url: '/schedules/'+id ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {

                        location.reload();

                        }
                       
                    
                });
           })
           $('.close').on('click',function(){
            $('#deleteModal').hide();

           })

         
        })
    </script>
    @endsection