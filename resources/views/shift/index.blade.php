@extends('layouts.app')
@section('title', 'Shifts Dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('shifts.create') }}" class="btn btn-outline-info  text-info  "><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{$status}}
                                </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('shifts.index')}}">All Status</a></li>
                                    <li><a class="dropdown-item" href="{{route('shifts.index','status=active')}}">Active</a></li>
                                    <li><a class="dropdown-item" href="{{route('shifts.index','status=inactive')}}">Inactive</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                </ul>
                            </div>  
                        </h1>
                        <div class="mt-3">
                            <span>All shifts ({{ $counts }}) | Public : <span class="text-info">({{$count_stt}})</span></span>
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
                                <h3 class="card-title" style="text-transform: uppercase">Shifts list</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="show-shifts">
                                @include('shift.table-paginate')
                            </div>                          
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
        $('body').delegate('.shifts_paginate a','click',function (){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_shifts(page);
        });

        function fetch_shifts(page){
            var _token = $("input[name=_token]").val();
            $.ajax({
                method: "POST",
                url: "{{route('shifts.fetch_shifts')}}",
                data:  {_token: _token, page:page},
                success: function(data) {                    
                    $('#show-shifts').html(data);
                }
            });
        }
    });
</script>
@endsection