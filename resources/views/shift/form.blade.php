@extends('layouts.app')
@section('title')
    {{isset($faculty) ? 'Edit Shift':'Create Shift '}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('shifts.index') }}" class="btn btn-danger text-light "><i
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($shift) ? 'Shift Edit' : 'Shift Add' }}</h3>
                            </div>
                            <form action="{{ isset($shift) ?  route('shifts.update',$shift->id) : route('shifts.store') }}" method="POST">
                                @csrf
                                @if (isset($shift))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                        @if (isset($shift)) value="{{ $shift->name }}" @endif placeholder="Name en" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Khmer') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="khmer"
                                        @if (isset($shift)) value="{{$shift->khmer}}" @endif  placeholder="name kh">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Session<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="session_id" style="width: 100%;">
                                                <option value="" disabled selected>Choose Status</option>
                                                @if (isset($shift)) 
                                                    @foreach ($sessions as $item)
                                                        <option value="{{$item->id}}" >
                                                            sdfd
                                                            {{date('h:i A', strtotime($item->start_date))}} - {{date('h:i A', strtotime($item->end_date))}} 
                                                        </option>          
                                                    @endforeach
                                                @else
                                                    @foreach ($sessions as $item)
                                                        <option value="{{$item->id}}">{{date('h:i A', strtotime($item->start_date))}} - {{date('h:i A', strtotime($item->end_date))}}  </option>          
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Stutus') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                                <option value="" disabled selected>Choose Status</option>
                                                <option value="1"@if (isset($shift)) {{ $shift->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($shift)) {{ $shift->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-success "> {{isset($shift) ? 'Update':'Publish' }}</button>
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