@extends('layouts.app')
@section('title', 'Faculties Dashboard')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Faculties Page

                        </h1>
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

                  @include('faculty.excel')
                    <div class="col-md-12">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title" style="text-transform: uppercase">Faculties list</h3>
                                <a href="{{ route('faculties.create') }}" class="btn btn-sm btn-info float-right"><i
                                        class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (session('message'))
                                    <div class="alert alert-info" role="alert">
                                        {{ session('message') }} <i class="fa fa-check" aria-hidden="true"></i>
                                    </div>
                                @endif

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
                                        @forelse ($faculties as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->khmer }}</td>

                                                <td>
                                                    @if ($item->status == 1)
                                                    <span class="badge bg-defalt">Active <i class="fa fa-circle text-success" aria-hidden="true"></i></span>
                                                    @else
                                                    <span class="badge bg-defalt">Inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i></span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('faculties.destroy', $item->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('faculties.show', $item->id) }}"
                                                            class=" btn btn-sm btn-info"><i class="fa fa-eye"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ route('faculties.edit', $item->id) }}"
                                                            class=" btn btn-sm btn-warning"><i class="fa fa-pencil-square-o"
                                                                aria-hidden="true"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger "><i class="fa fa-trash-o"
                                                                aria-hidden="true"></i></button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @empty
                                            <td colspan="5" class="text-center py-3">No Data Available</td>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <span>Faculties page: {{ $counts }}</span>
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
