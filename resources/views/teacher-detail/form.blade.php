@extends('layouts.app')
@section('title')
    {{isset($teachers_detail) ? 'Edit teacher details':'Create teacher details '}}
@endsection
@section('content')

<style>

label.img {
	display: block;
	width: 60vw;
	max-width: 300px;
	margin: 0 auto;
	background-color: rgb(34, 155, 74);
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
                            <a href="{{ route('teachers-details.index') }}" class="btn btn-danger text-light "><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> {{isset($teachers_detail) ? 'Cancel' : 'Back'}}</a>
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($teachers_detail) ? 'teacher details Edit' : 'teacher details Add' }}</h3>
                            </div>
                            <form action="{{ isset($teachers_detail) ? route('teachers-details.update',$teachers_detail->id) : route('teachers-details.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($teachers_detail))
                                    @method('PUT')
                                @endif
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Teacher code</label>
                                            <input type="text" class="form-control" name="teacher_code"
                                            @if (isset($teachers_detail)) value="{!! $teachers_detail->teacher_code !!}" @endif placeholder="teacher code" autofocus>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Teacher name</label>
                                            <select class="form-control select2" id="teacher_id" name="teacher_id" >
                                                <option value="" selected disabled>---</option>
                                                @if(isset($teachers_detail))
                                                    @foreach ($teachers as $item)
                                                        <option value="{{ $item->id }}" {{ $teachers_detail->teacher_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->teacher_name_en }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @forelse ($teachers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->teacher_name_en }}</option>
                                                    @empty
                                                        <option value="">No teachers available</option>
                                                    @endforelse
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control " id="status" name="sex" >
                                                <option value="" disabled selected>Gender</option>
                                                <option value="1" @if (isset($teachers_detail)) {{ $teachers_detail->status == '1' ? 'selected' : '' }}  @endif>Male</option>
                                                <option value="2" @if (isset($teachers_detail)) {{ $teachers_detail->status == '2' ? 'selected' : '' }}  @endif>Female</option>
                                                <option value="3" @if (isset($teachers_detail)) {{ $teachers_detail->status == '3' ? 'selected' : '' }}  @endif>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control" name="nationality"
                                            @if (isset($teachers_detail)) value="{{ $teachers_detail->nationality }}" @endif placeholder="Nationality" >
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                            @if (isset($teachers_detail)) value="{{ $teachers_detail->phone }}" @endif placeholder="Phone" >
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" cols="50" rows="3"> @if (isset($teachers_detail)) {{$teachers_detail->address}} @endif </textarea>
                                          </div>
                                        <div class="form-group">
                                            <label>Position <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="position_id" name="position_id" >
                                               <option value="" selected disabled>---</option>
                                                @if(isset($teachers_detail))
                                                    @foreach ($positions as $item)
                                                        <option value="{{ $item->id }}" {{ $teachers_detail->position_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @forelse ($positions as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @empty
                                                        <option value="">No positions available</option>
                                                    @endforelse
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select class="form-control " id="status" name="status" >
                                                <option value="" disabled selected>Choose Status</option>
                                                <option value="1"@if (isset($teachers_detail)) {{ $teachers_detail->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($teachers_detail)) {{ $teachers_detail->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                      <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                       
                                        <div class="form-group">
                                            <label>Date of birth</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="dob"  @if(isset($teachers_detail)) value="{{$teachers_detail->dob}}" @endif id="example" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                            @if (isset($teachers_detail)) value="{{ $teachers_detail->email }}" @endif placeholder="Email" >
                                        </div>
                                      <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Noted</label>
                                            <textarea name="noted" class="form-control" cols="50" placeholder="Describe (Optional)" rows="3">@if(isset($teachers_detail)){{$teachers_detail->noted}}@endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Expired date</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="expired_date" id="example" @if(isset($teachers_detail)) value="{{$teachers_detail->expired_date}}" @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Photo</label>
                                            <div class="box-img">
                                                <label class="img" style="max-width: 140px !important;" >
                                                    <input class="up-img" type="file" name="image" id="image" accept="image/*,.pdf">Browse image
                                                </label>
                                                @if (isset($teachers_detail))
                                                    <div class="mt-2 box-img">
                                                        <img id="preview-image-before-upload" src="{{url('uploads/teacher/'.$teachers_detail->image)}}"
                                                        alt="preview image" style="max-width: 140px;">
                                                    </div>
                                                @else
                                                    <div class="mt-2 box-img">
                                                        <img id="preview-image-before-upload" src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"
                                                        alt="preview image" style="max-width: 140px;">
                                                    </div>
                                                @endif
                                            </div>                                           
                                            {{-- <div class="box-img">
                                                <div class="loading"></div>
                                                <input type="file" name="image" id="image">
                                                <div class="del-img-box"></div>
                                                @error('image')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mt-4">
                                                <img id="preview-image-before-upload" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjLE9Ylr4f4BXaJfXkLC0YGydJDZVQoxK0Dg&usqp=CAU"
                                                alt="preview image" style="max-height: 200px;">
                                            </div> --}}
                                          
                                        </div>
                                      <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-success"> {{isset($teachers_detail) ? 'Update':'Publish' }}</button>
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
@section('script')
<script>

$(document).ready(function (e) { 
   
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

