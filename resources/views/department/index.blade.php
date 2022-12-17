@extends('layouts.app')
@section('title','Departments Dashboard')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('Departments Page')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    {{-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#!">Home</a></li>
                    </ol> --}}
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
                  <h3 class="card-title" style="text-transform: uppercase">{{__('Departments List')}}</h3>
                    <a href="{{route('departments.create')}}" class="btn btn-sm btn-info float-right"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  @if(session('message'))
                    <div class="alert alert-info" role="alert">
                      {{session('message')}} <i class="fa fa-check" aria-hidden="true"></i>
                    </div>
                  @endif

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>{{__('faculties type')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Khmer')}}</th>
                        <th>{{__('Noted')}}</th>
                        <th>{{__('Status')}}</th>
                        <th style="width: 200px">{{__('Action')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($departments as $key => $item )
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->faculty->name}}</td>
                        <td>{{$item->name ? $item->name : '---'}}</td>
                        <td>{{$item->khmer ? $item->khmer:'---'}}</td>
                        <td>{{$item->description ? $item->description : '---'}}</td>

                          <td>
                            @if ($item->status == 1)
                            <span class="badge bg-info">Active <i class="fa fa-check-circle" aria-hidden="true"></i></span>
                            @else
                            <span class="badge bg-danger">Inactive <i class="fa fa-ban" aria-hidden="true"></i></span>
                            @endif
                          </td>
                          <td>
                            <form action="{{route('departments.destroy',$item->id)}}" method="POST">
                              <a href="{{route('departments.show',$item->id)}}" class=" btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a href="{{route('departments.edit',$item->id)}}" class=" btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger "><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                          </td>

                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                 <span>Departments page: {{$counts}}</span>
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
