@extends('layouts.app')
@section('title', 'Majors Dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('majors.create') }}" class="btn btn-outline-info  text-info  "><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{$status}}
                                </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('majors.index')}}">All Status</a></li>
                                    <li><a class="dropdown-item" href="{{route('majors.index','status=active')}}">Active</a></li>
                                    <li><a class="dropdown-item" href="{{route('majors.index','status=inactive')}}">Inactive</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                </ul>
                            </div>  
                            <a href="{{ route('majors.index') }}" class="btn btn-info text-light"><i class="fa fa-history" aria-hidden="true"></i> Reload page</a>
                        </h1>
                        <div class="mt-3">
                            <span>All majors ({{ $counts }}) | Public : <span class="text-info">({{$count_stt}})</span></span>
                          </div>
                    </div><!-- /.col -->
                    
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
                                <h3 class="card-title" style="text-transform: uppercase">Majors list</h3>
                                <form action="{{route('majors.index')}}" method="GET" class="d-flex float-right" role="search">
                                    <div class="form-row "> 
                                        <div class="d-flex">
                                            <input class="form-control" value="{{ \Request::get('search') }}" title="type to search"
                                            name="search" id="search" type="text" placeholder="Search...">
                                            <button class="btn btn-info" type="submit" title="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>                      
                                    </div>
                                </form>     
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="show-majors">
                                    @include('majors.table-paginate')
                            </div>
                            <!-- /.card-body -->
                        </div>
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
        $('body').delegate('.majors_paginate a','click',function (){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_majors(page);
        });

        function fetch_majors(page){
            var _token = $("input[name=_token]").val();
            $.ajax({
                method: "POST",
                url: "{{route('majors.fetch_majors')}}",
                data:  {_token: _token, page:page},
                success: function(data) {                    
                    $('#show-majors').html(data);
                }
            });
        }
    });
</script>
@endsection