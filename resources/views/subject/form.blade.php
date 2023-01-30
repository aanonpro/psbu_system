@extends('layouts.app')
@section('title')
    {{isset($faculty) ? 'Edit Subject':'Create Subject '}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('subjects.index') }}" class="btn btn-danger text-light "><i
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($subject) ? 'Subject Edit' : 'Subject Add' }}</h3>
                            </div>
                            <form action="{{ isset($subject) ?  route('subjects.update',$subject->id) : route('subjects.store') }}" method="POST">
                                @csrf
                                @if (isset($subject))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Parent') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="parent"
                                        @if (isset($subject)) value="{{ $subject->parent }}" @endif placeholder="Parent" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title_en"
                                        @if (isset($subject)) value="{{ $subject->name }}" @endif placeholder="Name en" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Khmer') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title_kh"
                                        @if (isset($subject)) value="{{$subject->khmer}}" @endif  placeholder="name kh">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Shortcut word') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="shortcut"
                                        @if (isset($subject)) value="{{ $subject->shortcut }}" @endif placeholder="Short cut word" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Score parent') }} </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="score_parent"
                                        @if (isset($subject)) value="{{ $subject->score_parent }}" @endif placeholder="score parent" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Stutus') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                                <option value="" disabled selected>Choose Status</option>
                                                <option value="1"@if (isset($subject)) {{ $subject->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($subject)) {{ $subject->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-success "> {{isset($subject) ? 'Update':'Publish' }}</button>
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
