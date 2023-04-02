
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>N0</th>
            <th>ID</th>
            <th>Name Kh</th>
            <th>Name En</th>
            <th>Degree</th>
            <th>Shift</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Status</th>
            <th style="width: 130px">Action</th>
        </tr>
    </thead>
    <tbody id="show_degree">
        @forelse ($students as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{$item->stu_id ?? '--'}}</td>
                <td>{{ $item->stu_name ?? '--' }}</td>
                <td>{{ $item->stu_name_latin ?? '--' }}</td>
                <td>{{ $item->degree->name ?? '--' }}</td>
                <td>{{ $item->shift->name ?? '--' }}</td>
                <td>{{ $item->stu_gender ?? '--' }}</td>
                <td>{{ $item->stu_address ?? '--' }}</td>
                <td>{{ $item->stu_phone ?? '--' }}</td>
                <td>
                    @if ($item->status == 1)
                    <span class="badge bg-defalt text-dark">Active <i class="fa fa-circle text-success" aria-hidden="true"></i></span>
                    @else
                    <span class="badge bg-defalt text-dark">Inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i></span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('students.destroy', $item->id) }}"
                        method="POST">
                        <a href="{{ route('students.show', $item->id) }}"
                            class=" btn btn-sm btn-info text-light"><i class="fa fa-eye"
                                aria-hidden="true"></i></a>
                        <a href="{{ route('students.edit', $item->id) }}"
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
<div class="students_paginate float-right mt-4 ">
    {!! $students->appends($_GET)->links() !!}
</div>
