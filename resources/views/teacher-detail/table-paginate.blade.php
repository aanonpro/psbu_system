<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="width: 10px">#</th>
        <th>Photo</th>
        <th>Teacher name</th>
        <th>Teacher code</th>
        <th>Gender</th>
        <th>Date of birth</th>
        <th>Address</th>
        <th>Phone</th>       
        <th>Email</th>       
        <th>Status</th>
        <th style="width: 150px">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($teachers_details as $key => $item )
      <tr>
        <td>{{$key+1}}</td>
        <td>{{$item->photo}}</td>
        <td>{{$item->teacher->name}}</td>
        <td>{{$item->teacher_code ?? '---'}}</td>
        <td>{{$item->sex ?? '---'}}</td>
        <td>{{$item->dob ??'---'}}</td>
        <td>{{$item->address ??'---'}}</td>
        <td>{{$item->phone ??'---'}}</td>
        <td>{{$item->email ??'---'}}</td>

          <td>
            @if ($item->status == 1)
            <span class="badge bg-defalt text-dark">Active <i class="fa fa-circle text-success" aria-hidden="true"></i></span>
            @else
            <span class="badge bg-defalt text-dark">Inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i></span>
            @endif
          </td>
          <td>
            <form action="{{route('teachers-details.destroy',$item->id)}}" method="POST">
              <a href="{{route('teachers-details',$item->id)}}" class=" btn btn-sm btn-success text-light"><i class="fa fa-eye" aria-hidden="true"></i></a>
              <a href="{{route('teachers-details',$item->id)}}" class=" btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger "><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </form>
          </td>

      </tr>
      @empty
        <td colspan="11" class="text-center py-3">No Data Available</td>
    @endforelse

    </tbody>
</table>


<div class="teachers_details_paginate float-right mt-4">
    {!! $teachers_details->appends($_GET)->links() !!}
</div>