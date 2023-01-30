
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Teacher name en</th>
            <th>Teacher name kh</th>
            <th>Date</th>
            <th>Status</th>
            <th style="width: 200px">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($teachers as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->teacher_name_en ?? '--' }}</td>
                <td>{{ $item->teacher_name_kh ?? '--' }}</td>
                <td>{{ $item->created_at }}</td>

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
                            class=" btn btn-sm btn-success text-light"><i class="fa fa-eye"
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
            <td colspan="6" class="text-center py-3">No Data Available</td>
        @endforelse

    </tbody>
</table>
<div class="teachers_paginate float-right mt-4 ">
    {!! $teachers->appends($_GET)->links() !!}
</div>
