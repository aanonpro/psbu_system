@extends('layouts.app')
@section('title')
    {{isset($position) ? 'Edit Position':'Create Position '}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('positions.index') }}" class="btn btn-danger text-light "><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </h1>
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($position) ? 'Position Edit' : 'Position Add' }}</h3>
                            </div>
                            <form action="{{ isset($position) ?  route('positions.update',$position->id) : route('positions.store') }}" method="POST">
                                @csrf
                                @if (isset($position))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                        @if (isset($position)) value="{{ $position->name }}" @endif placeholder="name en" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Khmer') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="khmer"
                                        @if (isset($position)) value="{{$position->khmer}}" @endif  placeholder="khmer kh">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Noted') }} </label>
                                    <div class="col-sm-10">
                                       <textarea name="noted" class="form-control" cols="50" rows="3"> @if (isset($position)) {{$position->noted}} @endif </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Stutus') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                                <option value="" disabled selected>Choose Status</option>
                                                <option value="1"@if (isset($position)) {{ $position->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($position)) {{ $position->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-info "> {{isset($position) ? 'Update':'Publish' }}</button>
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
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @section('script')
        <script>
           Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{!! $error !!}',
            })
        </script>
        @endsection
    @endforeach
@endif
