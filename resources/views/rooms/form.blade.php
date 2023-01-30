@extends('layouts.app')
@section('title')
    {{isset($faculty) ? 'Edit room':'Create room '}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('rooms.index') }}" class="btn btn-danger text-light "><i
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
                            {{-- @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif --}}
                            <div class="card-header">
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($room) ? 'Faculty Edit' : 'room Add' }}</h3>
                            </div>
                            <form action="{{ isset($room) ?  route('rooms.update',$room->id) : route('rooms.store') }}" method="POST">
                                @csrf
                                @if (isset($room))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Room floor') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="floor"
                                        @if (isset($room)) value="{{ $room->floor }}" @endif placeholder="Floor number" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Room number') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="number"
                                        @if (isset($room)) value="{{ $room->number }}" @endif placeholder="Room number" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Room Name en') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                        @if (isset($room)) value="{{ $room->name }}" @endif placeholder="Name en" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Room Name kh') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="khmer"
                                        @if (isset($room)) value="{{$room->khmer}}" @endif  placeholder="name kh">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Room Chair') }} </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="chair"
                                        @if (isset($room)) value="{{ $room->chair }}" @endif placeholder="Chiar number" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Room table') }} </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="table"
                                        @if (isset($room)) value="{{ $room->table }}" @endif placeholder="Table number" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Room property') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="property"
                                        @if (isset($room)) value="{{ $room->property }}" @endif placeholder="Room property" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Room Stutus') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                               <option value="" disabled selected>Choose Status </option>
                                                <option value="1"@if (isset($room)) {{ $room->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($room)) {{ $room->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-success"  id="success"> {{isset($room) ? 'Update':'Publish' }}</button>
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
