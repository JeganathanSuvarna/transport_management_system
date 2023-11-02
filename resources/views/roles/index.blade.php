@extends('layouts.app')
@section('content')

<div class="content m-4 p-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Roles & Permissions</h4>
                        </div>
                        @php
            $role_name=Auth::user()->getRoleNames()[0];
            $role_per=Spatie\Permission\Models\Role::where('name',$role_name)->first();
            @endphp
                        <div class="col-4 text-right">
                        @if($role_per->hasPermissionTo('Add-Role'))

                            <a href="" class="btn btn-sm btn-primary addRole">Add Role</a>
                            @endif
                        </div>
                    </div>
                </div>
               
                <div class="card-body">

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th scope="col" style="width:25%">#</th>
                                    <th scope="col" style="width:25%">Name</th>
                                    <th scope="col" style="width:50%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key=>$role)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$role->name}}
                                    </td>
                                    <td>           
                                         @if($role_per->hasPermissionTo('Edit-Role'))

                                        <button type="button" class="btn btn-warning edit" data-id="{{$role->id}}">Edit</button>
                                      
                                        @if($role->status==1)
                                        <button type="button" class="btn btn-danger enable" data-id="{{$role->id}}">Enable</button>
                                        @else
                                        <button type="button" class="btn btn-primary disable" data-id="{{$role->id}}">Disable</button>

                                        @endif
                                        @endif
                                        @if($role_per->hasPermissionTo('Assign-Permissions'))

                                        <a href="/permission/{{$role->id}}"><button type="button" class="btn btn-success">Permission</button></a>
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
    <div class="modal" tabindex="-1" id="Role">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title heading"></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Role Name:</label>
            <input type="text" class="form-control role_name" id="role_name">
          </div>
          <input type="hidden" class="form-control role_id" >

          <div class="alert alert-danger required"style="display:none" role="alert">
Enter Role Name
</div>
<div class="alert alert-danger unique" style="display:none" role="alert">
Already Role is available
</div>

          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary addnew" id="role_add"></button>
      </div>
    </div>
  </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
   $(document).ready(function() {
    $('.addRole').click(function(e) {
        e.preventDefault();
        $('.heading').text('Add Role');
        $('#role_add').text('Add');
        $('.role_name').val('');
        $('.role_id').val(0);
        $('#Role').modal('show');
    });
    $('.addnew').click(function(e) {
        e.preventDefault();
        var role=$('.role_name').val();
        if(role.length>1 && $('.role_id').val()==0){
            $('.required').css('display','none');
            $.ajax({
                    type: 'POST',
                    url: '/roles' ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": role
                    },
                    success: function(response) {
                        if(response.error){
                            $('.unique').css('display','block');
                        }
                        else{
                            $('.unique').css('display','none');

                        location.reload();

                        }
                       
                    }
                });

        }
        else if($('.role_id').val()!=0){
            var id=$('.role_id').val();
            $.ajax({
                    type: 'PUT',
                    url: '/roles/'+id ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": role
                    },
                    success: function(response) {
                        if(response.error){
                            $('.unique').css('display','block');
                        }
                        else{
                            $('.unique').css('display','none');

                        location.reload();

                        }                   
                    }
                });

        }

        
        else{
            $('.required').css('display','block');
        }

    });

    $('.enable').on('click',function(e){
        e.preventDefault();
        var role_id=$(this).data('id');
        $.ajax({
                    type: 'DELETE',
                    url: '/roles/'+role_id ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        
                        location.reload();

                        
                       
                    }
                });


    })
    $('.disable').on('click',function(e){
        e.preventDefault();
        var role_id=$(this).data('id');
        $.ajax({
                    type: 'POST',
                    url: '/roles/disable/'+role_id ,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        
                        location.reload();

                        
                       
                    }
                });


    })
    $('.edit').on('click',function(){
        var role_id=$(this).data('id');
        $.ajax({
                    type: 'GET',
                    url: '/roles/'+role_id+'/edit',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('.heading').text('EditRole');
                        $('#role_add').text('Edit');
                        $('.role_name').val(response.role.name);
                        $('.role_id').val(response.role.id);
                        $('#Role').modal('show');

                        
                       
                    }
                });


    })
    })


        </script>
    @endsection