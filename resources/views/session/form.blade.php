@extends('layouts.app')
@section('title')
    {{isset($session) ? 'Edit session':'Create session '}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('sessions.index') }}" class="btn btn-danger text-light "><i
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($session) ? 'sessions Edit' : 'sessions Add' }}</h3>
                            </div>
                            <form action="{{ isset($session) ?  route('sessions.update',$session->id) : route('sessions.store') }}" method="POST">
                                @csrf
                                @if (isset($session))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Shift <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="shift_id" style="width: 100%;">
                                               <option value="" disabled selected>---</option>
                                                @if (isset($session))
                                                    @foreach ($shifts as $item )
                                                        <option value="{{$item->id}}" {{ $session->shift_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                                    @endforeach
                                                @else
                                                    @forelse ($shifts as $item )
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @empty
                                                    <option value="" disabled>No shift available</option>
                                                    @endforelse
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" name="name" type="radio" value="1"
                                                @if (isset($session)) {{ $session->name == '1' ? 'checked' : '' }}  @endif>
                                                <label style="width: 100px; font-weight: normal;" >Morning</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" name="name" type="radio" value="2"
                                                @if (isset($session)) {{ $session->name == '2' ? 'checked' : '' }}  @endif>
                                                <label style="width: 100px; font-weight: normal;" >Afternoon</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" name="name" type="radio" value="3"
                                                @if (isset($session)) {{ $session->name == '3' ? 'checked' : '' }}  @endif>
                                                <label style="width: 100px; font-weight: normal;" >Evening</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Time start</label>
                                    <div class="col-sm-4">
                                        <input type="time" class="form-control " name="start_date"
                                        @if (isset($session)) value="{{$session->start_date}}"  @endif/>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Time end</label>
                                    <div class="col-sm-4">
                                        <input type="time" class="form-control " name="end_date"
                                        @if (isset($session)) value="{{$session->end_date}}"  @endif/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-select" name="status" style="width: 100%;">
                                               <option value="" disabled selected>--- </option>
                                                <option value="1"@if (isset($session)) {{ $session->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($session)) {{ $session->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-info "> {{isset($session) ? 'Update':'Publish' }}</button>
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

@section('script')
@endsection
