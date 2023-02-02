@extends('layouts.app')
@section('title')
    {{isset($teachers_detail) ? 'Edit teacher details':'Create teacher details '}}
@endsection
@section('content')

<style>

    .box-img{
        width: 100px;
        height: 100px;
        border: 1px solid #ccc;
        background-image: url("{{ url('uploads/upload.png') }}");
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
                                                {{-- <div class="loading"></div> --}}
                                                <input type="file" name="image" id="text_file" onchange="previewFile(this);">
                                                {{-- <div class="del-img-box"></div> --}}
                                            </div>
                                            <div class="mt-4">
                                                <img id="previewImg" style="width: 100px;" src="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png" alt="Placeholder">

                                            </div>
                                          
                                            {{-- <label>File count demo</label>
                                            <input type="file" id="filecount" multiple="multiple"> --}}
                                            {{-- <div class="custom-file"> --}}
                                              
                                                {{-- <label class="custom-file-label" for="exampleInputFile" data-browse="Browser">Browser image</label> --}}
                                                {{-- <input type="file" name="image" class="form-control" style="max-width: 50%; background-color: #159153 !important;">
                                              </div> --}}
                                            {{-- <label>Upload photo</label>  
                                            <input class="form-control" name="image" type="file" accept="image/*" />
                                            @if (isset($teachers_detail))
                                                <img class="file-upload-image" src="{{ url('uploads/teacher/'.$teachers_detail->image) }}" 
                                                alt="{{($teachers_detail->image) }}" style="width: 200px;"/>
                                            @endif --}}
                                            {{-- <div class="file-upload">
                                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
                                                <div class="image-upload-wrap">
                                                    <input class="file-upload-input" name="image" type="file" onchange="readURL(this);" accept="image/*" />
                                                    <div class="drag-text">
                                                        <h3>
                                                        <i class="fa fa-cloud-upload  fa-3x" aria-hidden="true"></i><br>
                                                            Drag and drop Image</h3>
                                                    </div>
                                                </div>
                                                <div class="file-upload-content">
                                                    @if (isset($teachers_detail))
                                                        <img class="file-upload-image" src="{{ url('uploads/teacher/'.$teachers_detail->image) }}" alt="your image" />
                                                    @endif
                                               
                                                    <div class="image-title-wrap">                                                    
                                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                                    </div>
                                                </div>
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
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
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

