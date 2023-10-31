@extends('layouts.app')
@section('content')

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
                            <a href="/bus-info/create" class="btn btn-sm btn-primary">Add Bus Info</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
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
                                        <a href="/bus-info/{{$busInfo->id}}/edit"><button type="button" class="btn btn-warning">Edit</button></a>
                                       
                                        <button type="button" class="btn btn-primary delete" data-id="{{$busInfo->id}}">Delete</button>

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

    <script>
        $(document).ready(function() {
          $('.delete').on('click',function(){
            var bus_id=$(this).data('id');
          })
           

         
        })
    </script>
    @endsection