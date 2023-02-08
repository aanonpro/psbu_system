@extends('layouts.app')
@section('title')
    {{isset($faculty) ? 'Edit Subject':'Create Subject '}}
@endsection
@section('content')
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
                                    <label class="col-sm-2 col-form-label">Faculty type <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control select2" name="status" style="width: 100%;">
                                                <option value="" disabled selected>---</option>
                                                @if (isset($subject))
                                                    @foreach ($faculties as $item)
                                                        <option value="{{$item->id}}"{{ $subject->faculty_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @forelse ($faculties as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @empty
                                                        <option value="" disabled>No faculties available</option>
                                                    @endforelse
                                                @endif                                             
                                             
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Department type <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control select2" name="status" style="width: 100%;">
                                                <option value="" disabled selected>---</option>
                                                @if (isset($subject))
                                                    @foreach ($departments as $item)
                                                        <option value="{{$item->id}}"{{ $subject->department_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @forelse ($departments as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @empty
                                                        <option value="" disabled>No department available</option>
                                                    @endforelse
                                                @endif                                             
                                             
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Majors type <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control select2" name="status" style="width: 100%;">
                                                <option value="" disabled selected>---</option>
                                                @if (isset($subject))
                                                    @foreach ($majors as $item)
                                                        <option value="{{$item->id}}"{{ $subject->majors_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @forelse ($majors as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @empty
                                                        <option value="" disabled>No majors available</option>
                                                    @endforelse
                                                @endif                                             
                                             
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Semester <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                                <option value="" disabled selected>---</option>
                                                @if (isset($subject))
                                                    @foreach ($semesters as $item)
                                                        <option value="{{$item->id}}"{{ $subject->semester_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @forelse ($semesters as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @empty
                                                        <option value="" disabled>No semesters available</option>
                                                    @endforelse
                                                @endif       
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Academic <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                                <option value="" disabled selected>---</option>
                                                @if (isset($subject))
                                                    @foreach ($academics as $item)
                                                        <option value="{{$item->id}}"{{ $subject->academic_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @forelse ($academics as $item )
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @empty
                                                        <option value="" disabled>No academics available</option>
                                                    @endforelse
                                                @endif       
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Subjects Section<span
                                        class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <table class="table table-bordered">
                                            <thead class=" bg-primary">
                                                <tr>
                                                    <th>Name en</th>
                                                    <th>Name kh</th>
                                                    <th>ShortCut</th>
                                                    <th >Credit</th>
                                                    <th>Noted</th>
                                                    <th>Status</th>
                                                    <th> 
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-success text-light addRow"><i class="fa fa-plus" aria-hidden="true"></i>
                                                        </a>
                                                    </th>
                                                </tr>                                       
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" name="title_en"
                                                        @if (isset($subject)) value="{{ $subject->title_en }}" @endif placeholder="Name en">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="title_kh"
                                                        @if (isset($subject)) value="{{ $subject->title_kh }}" @endif placeholder="Name kh">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="shortcut"
                                                        @if (isset($subject)) value="{{ $subject->shortcut }}" @endif placeholder="Shortcut">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="credit"
                                                        @if (isset($subject)) value="{{ $subject->credit }}" @endif placeholder="Credit">
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="noted" rows="2" placeholder="(Optional)"> 
                                                        @if (isset($subject)) {{ $subject->noted }} @endif </textarea>
                                                    </td>
                                                    <td>
                                                        <select class="form-select" name="status" style="width: 100%;">
                                                            <option value="" disabled selected>Choose Status</option>
                                                            <option value="1"@if (isset($subject)) {{ $subject->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                            <option value="0"@if (isset($subject)) {{ $subject->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger text-light deleteRow"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                {{-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title_en"
                                        @if (isset($subject)) value="{{ $subject->name }}" @endif placeholder="Name en" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Khmer') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title_kh"
                                        @if (isset($subject)) value="{{$subject->khmer}}" @endif  placeholder="name kh">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Shortcut word') }} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="shortcut"
                                        @if (isset($subject)) value="{{ $subject->shortcut }}" @endif placeholder="Short cut word" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Score parent') }} </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="score_parent"
                                        @if (isset($subject)) value="{{ $subject->score_parent }}" @endif placeholder="score parent" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('Stutus') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="status" style="width: 100%;">
                                                <option value="" disabled selected>Choose Status</option>
                                                <option value="1"@if (isset($subject)) {{ $subject->status == '1' ? 'selected' : '' }}  @endif>{{__('Active')}}</option>
                                                <option value="0"@if (isset($subject)) {{ $subject->status == '0' ? 'selected' : '' }}  @endif>{{__('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
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
        $('thead').on('click','.addRow', function(){
            var tr = "<tr>"+

                        "<td><input type='text' class='form-control' name='title_en'"+
                            "@if (isset($subject)) value=' $subject->title_en ' @endif placeholder='Name en'>"+
                        "</td>"+
                        "<td><input type='text' class='form-control' name='title_kh'"+
                            "@if (isset($subject)) value=' $subject->title_kh' @endif placeholder='Name kh'>"+
                        "</td>"+
                        "<td><input type='text' class='form-control' name='shortcut'"+
                           "@if (isset($subject)) value=' $subject->shortcut ' @endif placeholder='Shortcut'>"+
                        "</td>"+
                        "<td><input type='text' class='form-control' name='credit'"+
                            "@if (isset($subject)) value=' $subject->credit ' @endif placeholder='Credit'>"+
                        "</td>"+
                        "<td><textarea class='form-control' name='noted' rows='2' placeholder='(Optional)'>"
                            "@if (isset($subject)) $subject->noted @endif </textarea>"+
                        "</td>"+
                        "<td>"+
                            "<select class='form-select' name='status' style='width: 100%;'>"+
                              "  <option value='' disabled selected>Choose Status</option>"+
                                "<option value='1' @if (isset($subject)) $subject->status == '1' ? 'selected' : ''  @endif>{{__('Active')}}</option>"+
                                "<option value='0' @if (isset($subject)) $subject->status == '0' ? 'selected' : ''  @endif>{{__('Inactive')}}</option>"+
                           " </select>"+
                        "</td>"+
                        "<td>"+
                            "<a href='javascript:void(0)' class='btn btn-sm btn-danger text-light deleteRow'><i class='fa fa-minus' aria-hidden='true'></i></a>"+
                        "</td>"+

                    "</tr>"+

            $('tbody').append(tr);
        });

        $('tbody').on('click', '.deleteRow', function(){
            $(this).parent().parent().remove();
        });
    });
</script>

@endsection