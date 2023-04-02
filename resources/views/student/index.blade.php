@extends('layouts.app')
@section('title', 'Student Dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('students.create') }}" class="btn btn-outline-info  text-info  "><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{$status}}
                                </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('students.index')}}">All Status</a></li>
                                    <li><a class="dropdown-item" href="{{route('students.index','status=active')}}">Active</a></li>
                                    <li><a class="dropdown-item" href="{{route('students.index','status=inactive')}}">Inactive</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                </ul>
                            </div>
                            <a href="{{ route('students.index') }}" class="btn btn-info text-light"><i class="fa fa-history" aria-hidden="true"></i> Reload page</a>

                        </h1>
                        <div class="mt-3">
                            <span>All students ({{ $counts }}) | Public : <span class="text-info">({{$count_stt}})</span></span>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control select2 bg-info" id="degree" name="degree" >
                                            <option value="" selected disabled>By Degree</option>
                                            @foreach ($degrees as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control select2 bg-info" id="shift" name="shift" >
                                            <option value="" selected disabled>By shift</option>
                                            @foreach ($shifts as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <form action="{{route('students.index')}}" method="GET" class="d-flex" role="search">
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
                                <h3 class="card-title" style="text-transform: uppercase">students list</h3>


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="show-students">
                                @include('student.table-paginate')
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
        $('body').delegate('.students_paginate a','click',function (){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_students(page);
        });

        function fetch_students(page){
            var _token = $("input[name=_token]").val();
            $.ajax({
                method: "POST",
                url: "{{route('students.fetch_students')}}",
                data:  {_token: _token, page:page},
                success: function(data) {
                    $('#show-students').html(data);
                }
            });
        }

        // end pagination
        $("#degree, #shift").on('change', function(){
        var degree = $(this).val();
        var shift = $(this).val();
        var _token = $("input[name=_token]").val();
        $.ajax({
            url: "{{route('students.index')}}",
            type: "GET",
            data: {_token: _token, degree: degree, shift: shift},

            success:function(data){
              $("#show_degree").html("");
                $.each(data.students, function(key, item){
                  $("#show_degree").append('<tr>\
                                        <td>'+item.id+'</td>\
                                        <td>'+item.stu_id+'</td>\
                                        <td>'+item.stu_name+'</td>\
                                        <td>'+item.stu_name_latin+'</td>\
                                        <td>'+item.degree.name+'</td>\
                                        <td>'+item.shift.name+'</td>\
                                        <td>'+item.stu_gender+'</td>\
                                        <td>'+item.stu_address+'</td>\
                                        <td>'+item.stu_phone+'</td>\
                                        <td> <span class="badge bg-defalt text-dark"> '+((item.status) == 1 ? 'active <i class="fa fa-circle text-success" aria-hidden="true"></i>':'inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i>' )+' </span></td>\
                                        <td>\
                                            <form action="students/'+item.id+'" method="POST">\
                                              <a href="students/'+item.id+'" class=" btn btn-sm btn-success text-light"><i class="fa fa-eye" aria-hidden="true"></i></a>\
                                              <a href="students/'+item.id+'/edit/" class=" btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>\
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
