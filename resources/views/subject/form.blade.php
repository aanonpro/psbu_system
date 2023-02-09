@extends('layouts.app')
@section('title')
    {{isset($faculty) ? 'Edit Subject':'Create Subject '}}
@endsection
@section('content')
<style>
.f-khmer{
    font-family: 'Battambang', cursive;
}
</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">
                            <a href="{{ route('subjects.index') }}" class="btn btn-danger text-light "><i
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
                                <h3 class="card-title" style="text-transform: uppercase">{{ isset($subject) ? 'Subject Edit' : 'Subject Add' }}</h3>
                            </div>
                            <form action="{{ isset($subject) ?  route('subjects.update',$subject->id) : route('subjects.store') }}" method="POST">
                                @csrf
                                @if (isset($subject))
                                    @method('PUT')
                                @endif
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"><span class="f-khmer">មហាវិទ្យាល័យ</span> / Faculty <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control select2" name="faculty_id" style="width: 100%;">
                                                <option value="" disabled selected>Select Faculty</option>
                                                @if (isset($subject))
                                                    @foreach ($faculties as $item)
                                                        <option value="{{$item->id}}"{{ $subject->faculty_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($faculties as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach

                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label"><span class="f-khmer">ដឺប៉ាតេម៉ង់</span> / Department <span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control select2" name="department_id" style="width: 100%;">
                                                <option value="" disabled selected>Select Department</option>
                                                @if (isset($subject))
                                                    @foreach ($departments as $item)
                                                        <option value="{{$item->id}}"{{ $subject->department_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($departments as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach

                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"><span class="f-khmer">ជំនាញ</span> / Majors <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control select2" name="major_id" style="width: 100%;">
                                                <option value="" disabled selected>Select Majors</option>
                                                @if (isset($subject))
                                                    @foreach ($majors as $item)
                                                        <option value="{{$item->id}}"{{ $subject->majors_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($majors as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach

                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label"><span class="f-khmer">ឆមាស</span> / Semester <span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select class="form-select" name="semester_id" style="width: 100%;">
                                                <option value="" disabled selected>Select Semester</option>
                                                @if (isset($subject))
                                                    @foreach ($semesters as $item)
                                                        <option value="{{$item->id}}"{{ $subject->semester_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($semesters as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"><span class="f-khmer">ឆ្នាំទី</span> / Academic <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-select" name="academic_id" style="width: 100%;">
                                                <option value="" disabled selected>Select Academic</option>
                                                @if (isset($subject))
                                                    @foreach ($academics as $item)
                                                        <option value="{{$item->id}}"{{ $subject->academic_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->year }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($academics as $item )
                                                        <option value="{{$item->id}}">{{$item->year}}</option>
                                                    @endforeach

                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"><span class="f-khmer">មុខវិជ្ជា</span> / Subjects Section<span
                                        class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <table class="table table-bordered">
                                            <thead class=" bg-dark">
                                                <tr>
                                                    <th>Name en</th>
                                                    <th>Name kh</th>
                                                    <th>ShortCut</th>
                                                    <th >Credit</th>
                                                    <th>Noted</th>
                                                    <th>Status</th>
                                                    <th> Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="subjectAdd">
                                                <tr>
                                                    <td><input type="text" class="form-control" name="title_en[]"@if (isset($subject)) value="{{ $subject->title_en }}" @endif placeholder="Name en"></td>
                                                    <td><input type="text" class="form-control" name="title_kh[]"@if (isset($subject)) value="{{ $subject->title_kh }}" @endif placeholder="Name kh"></td>
                                                    <td><input type="text" class="form-control" name="shortcut[]"@if (isset($subject)) value="{{ $subject->shortcut }}" @endif placeholder="Shortcut"></td>
                                                    <td><input type="text" class="form-control" name="credit[]"@if (isset($subject)) value="{{ $subject->credit }}" @endif placeholder="Credit"></td>
                                                    <td><textarea class="form-control" name="noted[]" rows="1" placeholder="(Optional)">@if(isset($subject)){{ $subject->noted }}@endif</textarea></td>
                                                    <td><select class="form-select" name="status[]" style="width: 100%;">
                                                            <option value="1"selected @if (isset($subject)) {{ $subject->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                            <option value="0"@if (isset($subject)) {{ $subject->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                                        </select></td>
                                                    <th>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-success text-light addRow"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                <button type="submit" class="btn btn-success "> {{isset($subject) ? 'Update':'Publish' }}</button>
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
    $(document).ready(function(){
        $('.addRow').click(function(){
           var tr = '<tr><td><input type="text" class="form-control" name="title_en[]"@if (isset($subject)) value="{{ $subject->title_en }}" @endif placeholder="Name en"></td>'+
                                        '<td><input type="text" class="form-control" name="title_kh[]"@if (isset($subject)) value="{{ $subject->title_kh }}" @endif placeholder="Name kh"></td>'+
                                        '<td><input type="text" class="form-control" name="shortcut[]"@if (isset($subject)) value="{{ $subject->shortcut }}" @endif placeholder="Shortcut"></td>'+
                                        '<td><input type="text" class="form-control" name="credit[]"@if (isset($subject)) value="{{ $subject->credit }}" @endif placeholder="Credit"></td>'+
                                        '<td><textarea class="form-control" name="noted[]" rows="1" placeholder="(Optional)">@if(isset($subject)){{ $subject->noted }}@endif</textarea></td>'+
                                        '<td><select class="form-select" name="status[]" style="width: 100%;">'+
                                                '<option value="1" selected @if (isset($subject)) {{ $subject->status == "1" ? "selected" : "" }}  @endif>Active</option>'+
                                                '<option value="0"@if (isset($subject)) {{ $subject->status ==  "0" ? "selected" : ""  }}  @endif>Inactive</option>'+
                                            '</select></td>'+
                                        '<th><a href="javascript:void(0)" class="btn btn-sm btn-danger text-light deleteRow"><i class="fa fa-minus" aria-hidden="true"></i></a></th></tr>';
                                        $('#subjectAdd').append(tr);
                                    });



        $('tbody').on('click', '.deleteRow', function(){
            $(this).parent().parent().remove();
        });
    });
</script>

@endsection
