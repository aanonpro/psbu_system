
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Parent</th>
            <th>Name en</th>
            <th>Name kh</th>
            <th>Shortcut</th>
            <th>Score parent</th>
            <th>Status</th>
            <th style="width: 200px">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($subjects as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->parent ?? '--' }}</td>
                <td>{{ $item->name ?? '--' }}</td>
                <td>{{ $item->khmer ?? '--' }}</td>
                <td>{{ $item->shortcut ?? '--' }}</td>
                <td>{{ $item->score_parent ?? '--' }}</td>

                <td>
                    @if ($item->status == 1)
                    <span class="badge bg-defalt text-dark">Active <i class="fa fa-circle text-success" aria-hidden="true"></i></span>
                    @else
                    <span class="badge bg-defalt text-dark">Inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i></span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('subjects.destroy', $item->id) }}"
                        method="POST">
                        <a href="{{ route('subjects.show', $item->id) }}"
                            class=" btn btn-sm btn-success text-light"><i class="fa fa-eye"
                                aria-hidden="true"></i></a>
                        <a href="{{ route('subjects.edit', $item->id) }}"
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
            <td colspan="8" class="text-center py-3">No Data Available</td>
        @endforelse

    </tbody>
</table>
<div class="subjects_paginate float-right mt-4 ">
    {!! $subjects->appends($_GET)->links() !!}
</div>