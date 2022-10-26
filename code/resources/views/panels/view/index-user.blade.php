
<div class="table-responsive" style="overflow-x: auto ">

    <table class="table  ">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody  >

        @forelse ($users as $user)
            <tr>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                @if($user->role==='super')
                    <td> <span class="badge badge-pill badge-primary"  >{{$user->role }}</span></td>
                @elseif($user->role==='admin')
                    <td> <span class="badge badge-pill badge-primary"  >{{$user->role }}</span></td>
                @elseif($user->role==='user')
                    <td> <span class="badge badge-pill badge-primary "  >{{$user->role }}</span></td>

                @endif


                <td>
                    @can( 'view',$user )
                        <a href="{{ url("/users/{$user->id}") }}" class="btn btn-xs btn-success">Show</a>
                    @endcan
                    @can( 'update',$user )

                        <a href="{{ url("/users/{$user->id}/edit") }}" class="btn btn-xs btn-warning">Edit</a>
                    @endcan

                    @can( 'delete',$user )
                        <a href="{{ url("/users/{$user->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                    @endcan

                </td>
            </tr>

        @empty
            <tr>
                <td colspan="2">No user available.</td>
            </tr>
        @endforelse
        </tbody>

    </table>
</div>



<div class="text-center">
    {!! $users->appends(['search'=>Request::input('search')])->links() !!}


</div>

