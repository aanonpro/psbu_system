@extends('layouts.app')
@section('title')
    {{isset($academic) ? 'Edit academic':'Create academic '}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('academics.index') }}" class="btn btn-danger text-light "> Back</a>
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($academic) ? 'academics Edit' : 'academics Add' }}</h3>
                            </div>
                            <form action="{{ isset($academic) ?  route('academics.update',$academic->id) : route('academics.store') }}" method="POST">
                                @csrf
                                @if (isset($academic))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Year </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="year"
                                        @if (isset($academic)) value="{{ $academic->year }}" @endif placeholder="Name en" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Khmer</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="khmer"
                                        @if (isset($academic)) value="{{$academic->khmer}}" @endif  placeholder="Name kh">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                               <option value="" disabled selected>Choose Status </option>
                                                <option value="1"@if (isset($academic)) {{ $academic->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($academic)) {{ $academic->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-info "> {{isset($academic) ? 'Update':'Publish' }}</button>
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
