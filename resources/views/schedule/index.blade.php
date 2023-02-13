@extends('layouts.app')
@section('title', 'Schedule Dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('schedules.create') }}" class="btn btn-outline-info  text-info  "><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{$status}}
                                </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('schedules.index')}}">All Status</a></li>
                                    <li><a class="dropdown-item" href="{{route('schedules.index','status=active')}}">Active</a></li>
                                    <li><a class="dropdown-item" href="{{route('schedules.index','status=inactive')}}">Inactive</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                </ul>
                            </div>
                            <a href="{{ route('schedules.index') }}" class="btn btn-info text-light"><i class="fa fa-history" aria-hidden="true"></i> Reload page</a>
          
                        </h1>
                        <div class="mt-3">
                            <span>All schedules ({{ $counts }}) | Public : <span class="text-info">({{$count_stt}})</span></span>
                        </div>                     
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            {{-- <div class="col-md-4">
                                <select class="form-control select2 bg-info" id="position" name="position" >
                                    <option value="" selected disabled>Search by position...</option>
                                    @foreach ($positions as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-4">
                               
                            </div>
                            <div class="col-md-4">
                                <form action="{{route('schedules.index')}}" method="GET" class="d-flex" role="search">
                                    <input class="form-control d-flex" value="{{ \Request::get('search') }}" required title="type to search"
                                    name="search" id="search" type="text" placeholder="Search...">
                                    <button class="btn btn-info" type="submit" title="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                       
                    </div>


                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title" style="text-transform: uppercase">schedules list</h3>
                                
                               
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="show-schedules">
                                @include('schedule.table-paginate')
                            </div>
                        </div>

                        {{-- <div id="show-teachers">
                            @include('teacher.table-paginate')
                        </div> --}}
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

@endsection

@if (session('message'))
    @section('script')
    <script>
        Swal.fire(
        'Good job!',
        '{!! Session::get('message') !!}',
        'success')
    </script>
    @endsection
@endif

@section('script')
<script>
      // pagination
   $(function (){
        $('body').delegate('.schedules_paginate a','click',function (){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_schedules(page);
        });

        function fetch_schedules(page){
            var _token = $("input[name=_token]").val();
            $.ajax({
                method: "POST",
                url: "{{route('schedules.fetch_schedules')}}",
                data:  {_token: _token, page:page},
                success: function(data) {
                    $('#show-schedules').html(data);
                }
            });
        }
            // end pagination 


        $("#position").on('change', function(){
        var position = $(this).val();
        var _token = $("input[name=_token]").val();
        $.ajax({
            url: "{{route('teachers.index')}}",
            type: "GET",
            data: {_token: _token, position: position},

            success:function(data){
              $("#show_position").html("");
                $.each(data.teachers, function(key, item){
                  $("#show_position").append('<tr>\
                                        <td>'+item.id+'</td>\
                                        <td>'+item.code+'</td>\
                                        <td> <img src="uploads/teacher/'+item.image+'" width="50px"></td>\
                                        <td>'+item.name_en+'</td>\
                                        <td>'+item.sex+'</td>\
                                        <td>'+item.position.name+'</td>\
                                        <td>'+item.address+'</td>\
                                        <td>'+item.phone+'</td>\
                                        <td>'+item.email+'</td>\
                                        <td> <span class="badge bg-defalt text-dark"> '+((item.status) == 1 ? 'active <i class="fa fa-circle text-success" aria-hidden="true"></i>':'inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i>' )+' </span></td>\
                                        <td>\
                                            <form action="teachers/'+item.id+'" method="POST">\
                                              <a href="teachers/'+item.id+'" class=" btn btn-sm btn-success text-light"><i class="fa fa-eye" aria-hidden="true"></i></a>\
                                              <a href="teachers/'+item.id+'/edit/" class=" btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>\
                                              @csrf\
                                              @method('DELETE')\
                                              <button class="btn btn-sm btn-danger "><i class="fa fa-trash-o" aria-hidden="true"></i></button>\
                                            </form>\
                                        </td>\
                                      </tr>');
                });

            }
          });
        });
        //end search position with ajax
    });
</script>
@endsection
