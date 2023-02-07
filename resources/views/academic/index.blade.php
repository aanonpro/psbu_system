@extends('layouts.app')
@section('title', 'Academic Dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('academics.create') }}" class="btn btn-outline-success  text-success  "><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                               <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{$status}}
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('academics.index')}}">All Status</a></li>
                                <li><a class="dropdown-item" href="{{route('academics.index','status=active')}}">Active</a></li>
                                <li><a class="dropdown-item" href="{{route('academics.index','status= inactive')}}">Inactive</a></li>
                                <li><hr class="dropdown-divider"></li>
                                </ul>
                            </div>
                        </h1>
                        <div class="mt-3">
                            <span>All academics ({{ $counts }}) | Public : <span class="text-success">({{$count_stt}})</span></span>
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
                                <h3 class="card-title" style="text-transform: uppercase">academics list</h3>
                                <form action="{{route('academics.index')}}" method="GET" class="d-flex float-right" role="search">
                                    <div class="form-row ">
                                        <div class="d-flex">
                                            <input class="form-control" value="{{ \Request::get('search') }}" title="type to search"
                                            name="search" id="search" type="text" placeholder="Search...">
                                            <button class="btn btn-success" type="submit" title="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="show-academics">
                            @include('academic.table-paginate')
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
        $('body').delegate('.academics_paginate a','click',function (){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page){
            var _token = $("input[name=_token]").val();
            $.ajax({
                method: "POST",
                url: "{{route('academics.fetch_academics')}}",
                data:  {_token: _token, page:page},
                success: function(data) {

                    $('#show-academics').html(data);
                }
            });
        }
    });
</script>
@endsection
