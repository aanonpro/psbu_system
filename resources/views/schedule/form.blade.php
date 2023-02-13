@extends('layouts.app')
@section('title')
    {{isset($schedule) ? 'Edit Schedule':'Create Schedule '}}
@endsection
@section('content')
<style>
    
    label.img {
        display: block;
        width: 60vw;
        max-width: 300px;
        margin: 0 auto;
        background-color: rgb(43, 161, 190);
        border-radius: 2px;
        font-size: 1em;
        line-height: 2.5em;
        text-align: center;
        color: #fff;
        cursor: pointer;
    }

    label.img:hover {
        background-color: cornflowerblue;
    }

    label.img:active {
        background-color: mediumaquamarine;
    }

    input.up-img {
        border: 0;
        clip: rect(1px, 1px, 1px, 1px);
        height: 1px; 
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    
    }

    /* body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100vw;
        overflow: hidden;
        background-color: black;
    } */

        .box-img{
            width: 100px;
            height: 100px;
            /* border: 1px solid #ccc; */
            /* background-image: url("{{ url('uploads/upload.png') }}"); */
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            position: relative !important;
        }
        .box-img input{
            width: 120px;
            height: 120px;
            opacity: 0;
            align-content: center;
            cursor: pointer;
        }
        .box-img img{
            width: 140px;
            height: 140px;
            align-content: center;
            /* cursor: pointer; */
        }
        .del-img-box{
            width: 20px;
            height: 20px;
            background-image: url("{{ url('uploads/close.png') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            position: absolute !important;
            top: -10px;
            right: -10px;
            cursor: pointer;
        }
        .loading{
            width: 20px;
            height: 20px;
            background-image: url("{{ url('uploads/loading.gif') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            position: absolute !important;
            top: 40px;
            left: 40px;
        }   

</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('schedules.index') }}" class="btn btn-danger text-light ">{{isset($schedule)? 'Cancel':'Back'}}</a>
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($schedule) ? 'schedules Edit' : 'schedules Add' }}</h3>
                            </div>
                            <form action="{{ isset($schedule) ?  route('schedules.update',$schedule->id) : route('schedules.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($schedule))
                                    @method('PUT')
                                @endif
                            <div class="card-body mb-5">

                                <div class="row">
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class="form-control select2" id="department_id" name="department_id" >
                                                <option value="" selected disabled >Please select department</option>
                                                @if(isset($schedule))
                                                    @foreach ($departments as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->department_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($departments as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Shift</label>
                                            <select class="form-control select2" id="shift_id" name="shift_id" >
                                                <option value="" selected disabled >Please select shift</option>
                                                @if(isset($schedule))
                                                    @foreach ($shifts as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->shift_id == $item->id ? 'selected' : '' }}>
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

                                        <div class="form-group">
                                            <label>Teacher</label>
                                            <select class="form-control select2" id="teacher_id" name="teacher_id" >
                                                <option value="" selected disabled >Please select teacher</option>
                                                @if(isset($schedule))
                                                    @foreach ($teachers as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->teacher_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($teachers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>                                      

                                        {{-- <div class="form-group">
                                            <label>Name khmer</label>
                                            <input type="text" class="form-control" @if(isset($schedule)) value="{{$schedule->name_kh}}" @endif name="name_kh" autofocus>                                            
                                        </div>                                     
                                      
                                        <div class="form-group">
                                            <label>Teacher code</label>
                                            <input type="text" class="form-control"@if(isset($schedule)) value="{{$schedule->name_en}}" @endif name="code" >                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control"@if(isset($schedule)) value="{{$schedule->email}}" @endif name="email" >                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Describe</label>
                                            <textarea id="inputDescription" name="noted" class="form-control" rows="7">  @if(isset($schedule)){{$schedule->noted}} @endif</textarea>
                                           
                                        </div> --}}
                                    </div>
                                    {{-- end section 1 --}}
                                    <div class="col-md-3">   
                                        <div class="form-group">
                                            <label>Majors</label>
                                            <select class="form-control select2" id="major_id" name="major_id" >
                                                <option value="" selected disabled >Please select majors</option>
                                                @if(isset($schedule))
                                                    @foreach ($majors as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->major_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($majors as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Session</label>
                                            <select class="form-control select2" id="session_id" name="session_id" >
                                                <option value="" selected disabled >Please select shift</option>
                                                @if(isset($schedule))
                                                    @foreach ($sessions as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->session_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($sessions as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    
                                        {{-- <div class="form-group">
                                            <label>Name english</label>
                                            <input type="text" class="form-control" @if(isset($schedule)) value="{{$schedule->name_en}}" @endif name="name_en" >                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Position</label>
                                            <select class="form-control select2" id="position_id" name="position_id" >
                                                <option value="" selected disabled >Please select position</option>
                                                @if(isset($schedule))
                                                    @foreach ($positions as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->position_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($positions as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control"@if(isset($schedule)) value="{{$schedule->phone}}" @endif name="phone" >                                            
                                        </div> --}}
                                     
                                    </div>
                                    {{-- end section 2 --}}

                                    <div class="col-md-3"> 
                                        
                                        <div class="form-group">
                                            <label>Year</label>
                                            <select class="form-control select2" id="academic_id" name="academic_id" >
                                                <option value="" selected disabled >Please select year</option>
                                                @if(isset($schedule))
                                                    @foreach ($academics as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->academic_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($academics as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Room</label>
                                            <select class="form-control select2" id="room_id" name="room_id" >
                                                <option value="" selected disabled >Please select room</option>
                                                @if(isset($schedule))
                                                    @foreach ($rooms as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->room_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($rooms as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                       
                                        {{-- <div class="form-group">
                                            <label>Place of birth <span class="text-danger">*</span></label>                                       

                                            <select class="form-control select2" id="pob" name="pob" >
                                                <option value="" disabled selected>Please select country</option>
                                                <option value="1"@if (isset($teacher)) {{ $teacher->sex == '1' ? 'selected' : '' }}  @endif  >Phnom penh</option>
                                            </select>                                      
                                        </div>
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="status" name="status" >
                                                <option value="" disabled selected>Please select Status</option>
                                                <option value="1"@if (isset($teacher)) {{ $teacher->status == '1' ? 'selected' : '' }}  @endif>Active</option>
                                                <option value="0"@if (isset($teacher)) {{ $teacher->status == '0' ? 'selected' : '' }}  @endif>Inactive</option>
                                            </select>
                                        </div> --}}
                                       
                                    </div>
                                    {{-- end section 3 --}}

                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select class="form-control select2" id="semester_id" name="semester_id" >
                                                <option value="" selected disabled >Please select semester</option>
                                                @if(isset($schedule))
                                                    @foreach ($semesters as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->semester_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($semesters as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Subject</label>
                                            <select class="form-control select2" id="subject_id" name="subject_id" >
                                                <option value="" selected disabled >Please select subject</option>
                                                @if(isset($schedule))
                                                    @foreach ($subjects as $item)
                                                        <option value="{{ $item->id }}" {{ $schedule->subject_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($subjects as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        
                                       

                                        {{-- <div class="form-group">
                                            <label>Date of birth</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="dob"  @if(isset($schedule)) value="{{$schedule->dob}}" @endif id="example" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control"@if(isset($schedule)) value="{{$schedule->nationality}}" @endif name="nationality">                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Expired_date</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="expired_date"  @if(isset($schedule)) value="{{$schedule->expired_date}}" @endif id="example" class="form-control">
                                            </div>
                                        </div> --}}
                                    </div>
                                    {{-- end section 4 --}}
                                </div>

                                <div class="form-group row">
                                    {{-- <label class="col-sm-2 col-form-label"><span class="f-khmer">មុខវិជ្ជា</span> / Subjects Section<span
                                        class="text-danger">*</span> </label> --}}
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead class=" bg-dark">
                                                <tr>
                                                    <th>Moday</th>
                                                    <th>Tuesday</th>
                                                    <th>Wednesday</th>
                                                    <th>Thursday</th>
                                                    <th>Friday</th>
                                                    <th>Satauday</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="subjectAdd">
                                                <tr>
                                                    <td><input type="text" class="form-control" name="title_en[]"@if (isset($schedule)) value="{{ $schedule->title_en }}" @endif placeholder="Name en"></td>
                                                    <td><input type="text" class="form-control" name="title_kh[]"@if (isset($schedule)) value="{{ $schedule->title_kh }}" @endif placeholder="Name kh"></td>
                                                    <td><input type="text" class="form-control" name="shortcut[]"@if (isset($schedule)) value="{{ $schedule->shortcut }}" @endif placeholder="Shortcut"></td>
                                                    <td><input type="text" class="form-control" name="credit[]"@if (isset($schedule)) value="{{ $schedule->credit }}" @endif placeholder="Credit"></td>
                                                    <td><input type="text" class="form-control" name="credit[]"@if (isset($schedule)) value="{{ $schedule->credit }}" @endif placeholder="Credit"></td>
                                                    <td><input type="text" class="form-control" name="credit[]"@if (isset($schedule)) value="{{ $schedule->credit }}" @endif placeholder="Credit"></td>
                                                    <td><select class="form-select" name="status[]" style="width: 100%;">
                                                            <option value="1"selected @if (isset($schedule)) {{ $schedule->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                            <option value="0"@if (isset($schedule)) {{ $schedule->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                                        </select></td>
                                                    <th>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-info text-light addRow"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit"  class="btn bg-info "> {{isset($schedule) ? 'Update':'Publish' }}</button>
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

@section('script')
<script>
    $(function() {

        //image 
        $('#image').change(function(){                
        let reader = new FileReader();
        reader.onload = (e) => { 
            $('#preview-image-before-upload').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]);         
        });  
    });
</script>
@endsection