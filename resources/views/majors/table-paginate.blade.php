
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Department</th>
            <th>Code</th>
            <th>Name</th>
            <th>Khmer</th>
            <th>Status</th>
            <th style="width: 200px">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($majors as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{$item->department->name ?? '---'}}</td>
                <td>{{ $item->code ?? '---' }}</td>
                <td>{{ $item->name ?? '---' }}</td>
                <td>{{ $item->name_latin ?? '---' }}</td>

                <td>
                    @if ($item->status == 1)
                    <span class="badge bg-defalt text-dark">Active <i class="fa fa-circle text-success" aria-hidden="true"></i></span>
                    @else
                    <span class="badge bg-defalt text-dark">Inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i></span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('majors.destroy', $item->id) }}"
                        method="POST">
                        <a href="{{ route('majors.show', $item->id) }}"
                            class=" btn btn-sm btn-success text-light"><i class="fa fa-eye"
                                aria-hidden="true"></i></a>
                        <a href="{{ route('majors.edit', $item->id) }}"
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
            <td colspan="7" class="text-center py-3">No Data Available</td>
        @endforelse

    </tbody>
</table>
<div class="majors_paginate float-right mt-4 ">
    {!! $majors->appends($_GET)->links() !!}
</div>