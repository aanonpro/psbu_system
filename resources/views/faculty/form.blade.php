@extends('layouts.app')
@section('title')
    {{isset($faculty) ? 'Edit faculty':'Create faculty '}}
@endsection
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('faculties.index') }}" class="btn btn-danger text-light ">Back</a>
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($faculty) ? 'Faculty Edit' : 'Faculty Add' }}</h3>
                            </div>
                            <form action="{{ isset($faculty) ?  route('faculties.update',$faculty->id) : route('faculties.store') }}" method="POST">
                                @csrf
                                @if (isset($faculty))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                        @if (isset($faculty)) value="{{ $faculty->name }}" @endif placeholder="Name en" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Khmer') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="khmer"
                                        @if (isset($faculty)) value="{{$faculty->khmer}}" @endif  placeholder="name kh">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Stutus') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                               <option value="" disabled selected>Choose Status </option>
                                                <option value="1"@if (isset($faculty)) {{ $faculty->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($faculty)) {{ $faculty->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-info "> {{isset($faculty) ? 'Update':'Publish' }}</button>
                              </div>
                              <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
