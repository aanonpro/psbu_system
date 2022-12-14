@extends('layouts.app')
@section('title','Faculties Dashboard')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Faculties Page</h1>
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

<!-- Modal create form -->
@include('faculty.create-modal')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title" style="text-transform: uppercase">Faculties list</h3>
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#staticBackdrop">
                    Add Faculty
                  </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Khmer</th>
                        <th>Status</th>
                        <th style="width: 200px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($faculties as $item )

                      <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->khmer}}</td>

                          <td>
                            @if ($item->status == 1)
                            <span class="badge bg-info">Active <i class="fa fa-check-circle" aria-hidden="true"></i></span>
                            @else
                            <span class="badge bg-danger">Inactive <i class="fa fa-times-circle" aria-hidden="true"></i></span>
                            @endif
                          </td>
                          <td>
                            <form action="{{route('faculties.destroy',$item->id)}}" method="POST">
                              <a href="{{route('faculties.show',$item->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a href="{{route('faculties.edit',$item->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                          </td>

                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
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
