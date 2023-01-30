<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="width: 10px">#</th>
        <th>{{__('faculties type')}}</th>
        <th>{{__('Name')}}</th>
        <th>{{__('Khmer')}}</th>
        <th>{{__('Noted')}}</th>
        <th>{{__('Status')}}</th>
        <th style="width: 200px">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($departments as $key => $item )
      <tr>
        <td>{{$key+1}}</td>
        <td>{{$item->faculty->name}}</td>
        <td>{{$item->name ? $item->name : '---'}}</td>
        <td>{{$item->khmer ? $item->khmer:'---'}}</td>
        <td>{{$item->description ? $item->description : '---'}}</td>

          <td>
            @if ($item->status == 1)
            <span class="badge bg-defalt text-dark">Active <i class="fa fa-circle text-success" aria-hidden="true"></i></span>
            @else
            <span class="badge bg-defalt text-dark">Inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i></span>
            @endif
          </td>
          <td>
            <form action="{{route('departments.destroy',$item->id)}}" method="POST">
              <a href="{{route('departments.show',$item->id)}}" class=" btn btn-sm btn-success text-light"><i class="fa fa-eye" aria-hidden="true"></i></a>
              <a href="{{route('departments.edit',$item->id)}}" class=" btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger "><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </form>
          </td>

      </tr>
      @empty
        <td colspan="7" class="text-center py-3">No Data Available</td>
    @endforelse

    </tbody>
</table>


<div class="departments_paginate float-right mt-4">
    {!! $departments->appends($_GET)->links() !!}
</div>