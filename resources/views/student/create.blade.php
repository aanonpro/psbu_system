@extends('layouts.app')
@section('title', 'Students create')
@section('content')

    <style>
        .form-label{
            color: gray;
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        
                        <h1 class="m-0">
                            <a href="{{ route('students.index') }}" class="btn btn-danger text-light ">{{isset($student)? 'Cancel':'Back'}}</a>
                        </h1>
                    </div><!-- /.col -->
                  
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($student) ? 'students Edit' : 'students Add' }}</h3>
                            </div>
                            <form action="{{ isset($student) ?  route('students.update',$student->id) : route('students.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($student))
                                    @method('PUT')
                                @endif
                            <div class="card-body mb-5">

                                <div class="row">
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label>Student ID</label>
                                            <input type="text" class="form-control" value="{{ old('stu_id', $id) }}" name="stu_id" readonly>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Date of birth</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="dob"  @if(isset($student)) value="{{$student->dob}}" @endif id="example" class="form-control">
                                            </div>
                                            {{-- <input type="text" class="form-control" name="dob"@if(isset($teacher)) value="{{$teacher->dob}}" @else value="10/24/2023" @endif> --}}
                                        </div>  
                                        
                                        <div class="form-group">
                                            <label>Degree</label>
                                            <select class="form-control select2" id="degrees_id" name="degrees_id" >
                                                <option value="" selected disabled >Please select degree</option>
                                                @if(isset($student))
                                                    @foreach ($degrees as $item)
                                                        <option value="{{ $item->id }}" {{ $student->degrees_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($degrees as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- end section 1 --}}
                                    <div class="col-md-3">    
                                        <div class="form-group">
                                            <label>Student name kh</label>
                                            <input type="text" class="form-control" @if(isset($student)) value="{{$student->name_kh}}" @endif name="name_kh" autofocus>                                            
                                        </div>                                         
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" @if(isset($student)) value="{{$student->address}}" @endif>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Shift</label>
                                            <select class="form-control select2" id="shift_id" name="shift_id" >
                                                <option value="" selected disabled >Please select shift</option>
                                                @if(isset($student))
                                                    @foreach ($shifts as $item)
                                                        <option value="{{ $item->id }}" {{ $student->shift_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($shifts as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                    </div>
                                    {{-- end section 2 --}}

                                    <div class="col-md-3">    
                                        <div class="form-group">
                                            <label>student name en</label>
                                            <input type="text" class="form-control" @if(isset($student)) value="{{$student->name_en}}" @endif name="name_en" >                                            
                                        </div>   
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control"@if(isset($student)) value="{{$student->phone}}" @endif name="phone" >                                            
                                        </div> 

                                        <div class="form-group">
                                            <label>Batch</label>
                                            <select class="form-control select2" id="batch_id" name="batch_id" >
                                                <option value="" selected disabled >Please select batch</option>
                                                @if(isset($student))
                                                    @foreach ($batchs as $item)
                                                        <option value="{{ $item->id }}" {{ $student->batch_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($batchs as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>                                
                                       
                                    </div>
                                    {{-- end section 3 --}}

                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label>Gender <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="sex" name="sex" >
                                                <option value="" disabled selected>Please select gender</option>
                                                <option value="male"@if (isset($student)) {{ $student->sex == 'male' ? 'selected' : '' }}  @endif >Male</option>
                                                <option value="female"@if (isset($student)) {{ $student->sex == 'female' ? 'selected' : '' }}  @endif >Female</option>
                                                <option value="other"@if (isset($student)) {{ $student->sex == 'other' ? 'selected' : '' }}  @endif >Other</option>
                                            </select>                                      
                                        </div>    

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control"@if(isset($student)) value="{{$student->email}}" @endif name="email" >                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="status" name="status" >
                                                <option value="" disabled selected>Please select Status</option>
                                                <option value="1"@if (isset($student)) {{ $student->status == '1' ? 'selected' : '' }}  @endif>Active</option>
                                                <option value="0"@if (isset($student)) {{ $student->status == '0' ? 'selected' : '' }}  @endif>Inactive</option>
                                            </select>
                                        </div>

                                      
                                    </div>
                                    {{-- end section 4 --}}
                                </div>

                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit"  class="btn bg-info "> {{isset($student) ? 'Update':'Publish' }}</button>
                              </div>
                              <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
