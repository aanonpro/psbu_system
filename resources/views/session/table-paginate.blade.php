<table class="table table-bordered table-striped" >
    <thead>
        <tr>
            <th style="width: 50px">#</th>
            <th>Shift name</th>
            <th>Time start</th>
            {{-- <th>Time end</th> --}}
            <th>Status</th>
            <th style="width: 16%">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($sessions as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{$item->shift->name}}</td>
                <td>{{ date('h:i A', strtotime($item->start_date)) ?? '--' }} - {{ date('h:i A', strtotime($item->end_date)) ?? '--' }}</td>
                {{-- <td>{{ date('h:i A', strtotime($item->end_date)) ?? '--' }}</td> --}}

                <td>
                    @if ($item->status == 1)
                    <span class="badge bg-defalt text-dark">Active <i class="fa fa-circle text-success" aria-hidden="true"></i></span>
                    @else
                    <span class="badge bg-defalt text-dark">Inactive <i class="fa fa-circle text-danger" aria-hidden="true"></i></span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('sessions.destroy', $item->id) }}"
                        method="POST">
                        <a href="{{ route('sessions.show', $item->id) }}"
                            class=" btn btn-sm btn-success"><i class="fa fa-eye text-light"
                                aria-hidden="true"></i></a>
                        <a href="{{ route('sessions.edit', $item->id) }}"
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

<div class="sessions_paginate float-right mt-4 ">
    {!! $sessions->appends($_GET)->links() !!}
</div>
