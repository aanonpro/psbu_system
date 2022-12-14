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
                                <div class="col-md-9 py-2" style="margin: 0 auto;">
                                    <form action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store')   }}" method="POST">
                                        @csrf
                                        @if(isset($department))
                                            @method('PUT')
                                        @endif
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" @if (isset($department)) value="{{$department->name}}" @endif 
                                                name="name" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="description">@if (isset($department)) {{$department->description}} @endif </textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span> </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status" required>
                                                    @if(!isset($department))<option value="">-----Select function------</option>@endif
                                                    <option value="1" @if (isset($department)) {{ $department->status == '1' ? 'selected' : '' }}  @endif>Active</option>
                                                    <option value="0" @if (isset($department)) {{ $department->status == '0' ? 'selected' : '' }}  @endif>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                @if (isset($department))
                                                <button type="submit" class="btn btn-primary mt-4"> Update </button>
                                                @else
                                                <button type="submit" class="btn btn-primary mt-4"> Save </button>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

