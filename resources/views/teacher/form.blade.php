@extends('layouts.app')
@section('title')
    {{isset($teacher) ? 'Edit Teacher':'Create Teacher '}}
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
                            <a href="{{ route('teachers.index') }}" class="btn btn-danger text-light ">{{isset($teacher)? 'Cancel':'Back'}}</a>
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($teacher) ? 'teachers Edit' : 'teachers Add' }}</h3>
                            </div>
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <form action="{{ isset($teacher) ?  route('teachers.update',$teacher->id) : route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($teacher))
                                    @method('PUT')
                                @endif
                            <div class="card-body mb-5">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name khmer <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" @if(isset($teacher)) value="{{$teacher->name_kh}}" @endif name="name_kh" autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label>ID</label>
                                            <input type="text" class="form-control" value="{{ old('code', $id) }}" name="code" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control"@if(isset($teacher)) value="{{$teacher->email}}" @endif name="email" >
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Describe</label>
                                            <textarea id="inputDescription" name="noted" class="form-control" rows="7">  @if(isset($teacher)){{$teacher->noted}} @endif</textarea>

                                        </div>
                                    </div>
                                    {{-- end section 1 --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name english</label>
                                            <input type="text" class="form-control" @if(isset($teacher)) value="{{$teacher->name_en}}" @endif name="name_en" >
                                        </div>
                                        <div class="form-group">
                                            <label>Position</label>
                                            <select class="form-control select2" id="position_id" name="position_id" >
                                                <option value="" selected disabled >Please select position</option>
                                                @if(isset($teacher))
                                                    @foreach ($positions as $item)
                                                        <option value="{{ $item->id }}" {{ $teacher->position_id == $item->id ? 'selected' : '' }}>
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
                                            <input type="text" class="form-control"@if(isset($teacher)) value="{{$teacher->phone}}" @endif name="phone" >
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Photo</label>
                                            <div class="box-img">
                                                <label class="img" style="max-width: 140px !important;" >
                                                    <input class="up-img" type="file" name="image" id="image" accept="image/*,.pdf">Browse image
                                                </label>
                                                @if (isset($teacher))
                                                    <div class="mt-2 box-img">
                                                        <img id="preview-image-before-upload" src="{{url('uploads/teacher/'.$teacher->image)}}"
                                                        alt="preview image" style="max-width: 140px;">
                                                    </div>
                                                @else
                                                    <div class="mt-2 box-img">
                                                        <img id="preview-image-before-upload" src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"
                                                        alt="preview image" style="max-width: 140px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    {{-- end section 2 --}}

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="sex" name="sex" >
                                                <option value="" disabled selected>Please select gender</option>
                                                <option value="male"@if (isset($teacher)) {{ $teacher->sex == 'male' ? 'selected' : '' }}  @endif >Male</option>
                                                <option value="female"@if (isset($teacher)) {{ $teacher->sex == 'female' ? 'selected' : '' }}  @endif >Female</option>
                                                <option value="other"@if (isset($teacher)) {{ $teacher->sex == 'other' ? 'selected' : '' }}  @endif >Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Place of birth <span class="text-danger">*</span></label>

                                            <select class="form-control select2" id="pob" name="pob" >
                                                <option value="" disabled selected>Please select country</option>
                                                <option value="1"@if (isset($teacher)) {{ $teacher->pob == '1' ? 'selected' : '' }}  @endif  >Phnom penh</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" @if(isset($teacher)) value="{{$teacher->address}}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="status" name="status" >
                                                {{-- <option value="" disabled selected>Please select Status</option> --}}
                                                <option value="1"@if (isset($teacher)) {{ $teacher->status == '1' ? 'selected' : '' }}  @endif>Active</option>
                                                <option value="0"@if (isset($teacher)) {{ $teacher->status == '0' ? 'selected' : '' }}  @endif>Inactive</option>
                                            </select>
                                        </div>

                                    </div>
                                    {{-- end section 3 --}}

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date of birth</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="dob"  @if(isset($teacher)) value="{{$teacher->dob}}" @endif id="example" class="form-control">
                                            </div>
                                            {{-- <input type="text" class="form-control" name="dob"@if(isset($teacher)) value="{{$teacher->dob}}" @else value="10/24/2023" @endif> --}}
                                        </div>
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control"@if(isset($teacher)) value="{{$teacher->nationality}}" @endif name="nationality">
                                        </div>
                                        <div class="form-group">
                                            <label>Expired_date</label>
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input placeholder="Select date" type="date" name="expired_date"  @if(isset($teacher)) value="{{$teacher->expired_date}}" @endif id="example" class="form-control">
                                            </div>
                                            {{-- <input type="text" class="form-control"name="expired_date"@if(isset($teacher)) value="{{$teacher->expired_date}}" @else value="10/24/2023" @endif />                                      --}}
                                        </div>
                                    </div>
                                    {{-- end section 4 --}}
                                </div>

                            </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit"  class="btn bg-info "> {{isset($teacher) ? 'Update':'Publish' }}</button>
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
