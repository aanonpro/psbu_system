@extends('layouts.app')
@section('title')
    {{isset($major) ? 'Edit majors':'Create majors '}}
@endsection
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Majors Page</h1>
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
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($major) ? 'Majors Edit' : 'Majors Add' }}</h3>
                            </div>
                            <form action="{{ isset($major) ?  route('majors.update',$major->id) : route('majors.store') }}" method="POST">
                                @csrf
                                @if (isset($major))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Majors') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="faculty" name="faculty_id" >
                                            @if (!isset($major)) <option value="">---   </option>@endif
                                            @if(isset($major))
                                                @foreach ($faculties as $item)
                                                    <option value="{{ $item->id }}" {{ $major->faculty_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @forelse ($faculties as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @empty
                                                    <option value="">No faculties available</option>
                                                @endforelse
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Code') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="code"
                                        @if (isset($major)) value="{{ $major->code }}" @endif placeholder="Code ex: 123" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                        @if (isset($major)) value="{{ $major->name }}" @endif placeholder="Name en" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Khmer') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name_latin"
                                        @if (isset($major)) value="{{$major->name_latin}}" @endif  placeholder="name kh">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Stutus') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="status" name="status" >
                                            @if (!isset($major)) <option value="">Choose Status</option>@endif
                                            <option value="1"@if (isset($major)) {{ $major->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                            <option value="0"@if (isset($major)) {{ $major->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-sm  "> {{isset($major) ? 'Update':'Save' }}</button>
                                <a href="{{ route('majors.index') }}" class="btn btn-sm btn-default float-right ">{{ isset($major) ? 'Cancel' : 'Back' }}</a>
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
