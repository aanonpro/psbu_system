@extends('layouts.app')
@section('title')
    {{isset($teacherDetail) ? 'Edit teacher details':'Create teacher details '}}
@endsection
@section('content')
<style>

    .file-upload {
  background-color: #ffffff;
  max-width: 500px;
  margin: 0 auto;
  /* padding: 20px; */
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #1FB264;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #15824B;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #1AA059;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  /* margin-top: 10px; */
  border: 4px dashed #1FB264;
  position: relative;
  max-height: 210px;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #1FB264;
  border: 4px dashed #ffffff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 50;
  /* text-transform: uppercase; */
  color: #15824B;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($teacherDetail) ? 'teacher details Edit' : 'teacher details Add' }}</h3>
                            </div>
                            <form action="{{ isset($teacherDetail) ?  route('teachers-details.update', $teacherDetail->id) : route('teachers-details.store') }}" method="POST">
                                @csrf
                                @if (isset($teacherDetail))
                                    @method('PUT')
                                @endif
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Teacher code</label>
                                            <input type="text" class="form-control" name="teacher_code"
                                            @if (isset($teacherDetail)) value="{{ $teacherDetail->teacher_code }}" @endif placeholder="teacher code" autofocus>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Teacher name</label>
                                            <select class="form-control select2" id="teacher_id" name="teacher_id" >
                                                @if (!isset($teacherDetail)) <option value="" selected disabled>---</option>@endif
                                                @if(isset($teacherDetail))
                                                    @foreach ($teachers as $item)
                                                        <option value="{{ $item->id }}" {{ $teacherDetail->teacher_id == $item->id ? 'selected' : '' }}>
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
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="3">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control" name="nationality"
                                            @if (isset($teacherDetail)) value="{{ $teacherDetail->nationality }}" @endif placeholder="nationality" >
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                            @if (isset($teacherDetail)) value="{{ $teacherDetail->phone }}" @endif placeholder="phone" >
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" cols="50" rows="3"> @if (isset($teacherDetail)) {{$teacherDetail->address}} @endif </textarea>
                                          </div>
                                        <div class="form-group">
                                            <label>Position <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="position_id" name="position_id" >
                                                @if (!isset($teacherDetail)) <option value="" selected disabled>---</option>@endif
                                                @if(isset($teacherDetail))
                                                    @foreach ($positions as $item)
                                                        <option value="{{ $item->id }}" {{ $teacherDetail->position_id == $item->id ? 'selected' : '' }}>
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
                                                <option value="1"@if (isset($teacherDetail)) {{ $teacherDetail->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($teacherDetail)) {{ $teacherDetail->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                      <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <div class="file-upload">
                                                {{-- <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button> --}}
                                                <div class="image-upload-wrap">
                                                <input class="file-upload-input" name="photo" type='file' onchange="readURL(this);" accept="image/*" />
                                                <div class="drag-text">
                                                    <h3>
                                                    <i class="fa fa-cloud-upload  fa-3x" aria-hidden="true"></i><br>
                                                        Drag and drop Image</h3>
                                                </div>
                                                </div>
                                                <div class="file-upload-content">
                                                <img class="file-upload-image" src="#" alt="your image" />
                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Date of birth</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="dob" id="example" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                            @if (isset($teacherDetail)) value="{{ $teacherDetail->phone }}" @endif placeholder="email" >
                                        </div>
                                      <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Noted</label>
                                            <textarea name="noted" class="form-control" cols="50" rows="3"> @if (isset($teacherDetail)) {{$teacherDetail->noted}} @endif </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Expired date</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="expired_date" id="example" class="form-control">
                                            </div>
                                        </div>
                                      <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-success"> {{isset($teacherDetail) ? 'Update':'Publish' }}</button>
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
<script>
    function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});
</script>
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

