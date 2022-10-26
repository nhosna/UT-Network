
<div class="table-responsive" style="overflow-x: auto ">

    <table class="table  ">
    <thead>
    <tr>
        <th>Group Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($groups as $group)


        <tr>
{{--            <td >--}}

{{--             <a href="{{route('group.feed',$group->id)}}"> {{ $group->name }}</a>--}}
{{--            </td>--}}
{{--            --}}
            <td >

                 {{  Str::limit($group->name )}}
            </td>

            <td>
                @can( 'view',$group )
                <a href="{{ url("/groups/{$group->id}") }}" class="btn btn-xs btn-success">Show</a>
                @endcan
              @can( 'update',$group )
                    <a href="{{ url("/groups/{$group->id}/edit") }}" class="btn btn-xs btn-warning">Edit</a>
              @endcan

              @can( 'delete',$group )
                <a href="{{ url("/groups/{$group->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
              @endcan

            </td>


        </tr>

    @empty
        <tr>
            <td colspan="2">No groups available.</td>
        </tr>
    @endforelse


    </tbody>


</table>
</div>


<div class="text-center">

    {!! $groups->appends(['search'=>Request::input('search')])->links() !!}


</div>




