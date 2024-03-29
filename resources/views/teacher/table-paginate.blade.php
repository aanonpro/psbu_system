
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>ID</th>
            <th>Photo</th>
            <th>Name Kh</th>
            <th>Name En</th>
            <th>Position</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Status</th>
            <th style="width: 130px">Action</th>
        </tr>
    </thead>
    <tbody id="show_position">
        @forelse ($teachers as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{$item->code ?? '--'}}</td>
                <td>
                    @if($item->image)
                    <img src="{{ url('uploads/teacher/'.$item->image) }}" width="40px" style="border-radius: 50%; ">
                    @else
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjLE9Ylr4f4BXaJfXkLC0YGydJDZVQoxK0Dg&usqp=CAU" width="40px" style="border-radius: 50%; ">
                    @endif
                </td>
                <td>{{ $item->name_kh ?? '--' }}</td>
                <td>{{ $item->name_en ?? '--' }}</td>
                {{-- <td>{{ $item->sex ?? '--' }}</td> --}}
                <td>{{ $item->position->name ?? '--' }}</td>
                <td>{{ $item->address ?? '--' }}</td>
                <td>{{ $item->phone ?? '--' }}</td>

                <td>
                    @if ($item->status == 1)
                    <span class="badge bg-defalt text-dark">Active <i class="fa fa-circle text-success" aria-hidden="true"></i></span>
                    @else
                    <span class="badge bg-defalt text-dark">Inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i></span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('teachers.destroy', $item->id) }}"
                        method="POST">
                        <a href="{{ route('teachers.show', $item->id) }}"
                            class=" btn btn-sm btn-info text-light"><i class="fa fa-eye"
                                aria-hidden="true"></i></a>
                        <a href="{{ route('teachers.edit', $item->id) }}"
                            class=" btn btn-sm btn-warning"><i class="fa fa-pencil-square-o"
                                aria-hidden="true"></i></a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger "><i class="fa fa-trash-o"
                                aria-hidden="true"></i></button>
                    </form>
                </td>

            </tr>
        @empty
            <td colspan="11" class="text-center py-3">No Data Available</td>
        @endforelse

    </tbody>
</table>
<div class="teachers_paginate float-right mt-4 ">
    {!! $teachers->appends($_GET)->links() !!}
</div>
