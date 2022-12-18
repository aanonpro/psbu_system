@extends('layouts.app')
@section('title')
    {{isset($department) ? 'Edit departments':'Create departments '}}
@endsection
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Departments Page</h1>
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
                        <div class="card card-info ">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($department) ? 'Department Edit' : 'Department Add' }}</h3>
                            </div>
                            <form action="{{ isset($department) ?  route('departments.update',$department->id) : route('departments.store') }}" method="POST">
                                @csrf
                                @if (isset($department))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Faculty') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="faculty" name="faculty_id" >
                                            @if (!isset($department)) <option value="">Choose faculties</option>@endif
                                            @if(isset($department))
                                                @foreach ($faculties as $item)
                                                    <option value="{{ $item->id }}" {{ $department->faculty_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach ($faculties as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                        @if (isset($department)) value="{{ $department->name }}" @endif placeholder="Name en" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Khmer') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="khmer"
                                        @if (isset($department)) value="{{$department->khmer}}" @endif  placeholder="name kh">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Description') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                       <textarea name="description" class="form-control" cols="50" rows="3"> @if (isset($department)) {{$department->description}} @endif </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Stutus') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="status" name="status" >
                                            @if (!isset($department)) <option value="">Choose Status</option>@endif
                                            <option value="1"@if (isset($department)) {{ $department->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                            <option value="0"@if (isset($department)) {{ $department->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-sm  "> {{isset($department) ? 'Update':'Save' }}</button>
                                <a href="{{ route('departments.index') }}" class="btn btn-sm btn-default float-right ">{{ isset($department) ? 'Cancel' : 'Back' }}</a>
                              </div>
                              <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
