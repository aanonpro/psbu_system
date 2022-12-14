@extends('layouts.app')
@section('title','Department Pages')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Department</h1>
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
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row" >
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th scope="col">N0</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Note</th>
                                        <th scope="col"  style="width: 15%;">Status</th>
                                        <th scope="col" style="width: 20%;">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ( $products as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                @if($item->status == 1)
                                                <span class="badge badge-success"> <i class="bx bxs-circle align-middle me-1"></i>Active</span>
                                                @else
                                                <span class="badge badge-danger"> <i class="bx bxs-circle align-middle me-1"></i>Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{route('departments.destroy', $item->id)}}" method="POST">
                                                    <a href="{{route('departments.show', $item->id)}}" class="btn btn-sm btn-info text-light">View</a>
                                                    <a href="{{route('departments.edit', $item->id)}}" class="btn btn-sm btn-warning text-light">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger sweetAlert" type="submit">Delete</button>
                                                </form>
                                            </td>
                                          </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4"><h5>No Departments Record</h5></td>
                                            </tr>
                                        @endforelse
                                     
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>
  
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection
@section('script')
    <script>
        $('.sweetAlert').on('click', function () {
            swal({
                title: "Good job!",
                text: "Department delete successfully",
                icon: "success",
                button: "OK",
            });
        });
    </script>
@endsection

