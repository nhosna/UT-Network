
<div class="table-responsive" style="overflow-x: auto ">

<table class="table  ">
    <thead>
    <tr  >
        <th>Title</th>
        <th>Body</th>
        <th>Author</th>
        <th>Group</th>
        <th>Vote Type</th>
        <th>Expires</th>
        <th>Results</th>
        <th>Action</th>
    </tr>
    </thead>


    <tbody   >
    @forelse ($posts as $post)
        <tr >
            <td>{{ Str::limit($post->title,30) }}</td>
            <td>{{ Str::limit($post->body,40)  }} </td>
            <td> <a href="users/{{$post->user->id}}">{{ $post->user->first_name }} {{ $post->user->last_name }} </a></td>
            <td>   <a href="/groups/{{$post->group->id}}/"> {{ Str::limit($post->group->name,20) }}</a></td>
            <td>{{ $post->vote_type }}</td>
            <td>{{is_null($post->expires_at)?"won't expire": $post->expires_at->diffForHumans() }}</td>
{{--            <td>@include('partials.vote-index-post-result',['type'=>$post->vote_type,'value'=>$post->voteResult()]) </td>--}}
           <td>
               {{$post->voteCountIndex()}} votes

           </td>

            <td>

                <a href="{{ url("/posts/{$post->id}") }}" class="btn btn-xs btn-success">Show</a>
                <a href="{{ url("/posts/{$post->id}/edit") }}" class="btn btn-xs btn-warning">Edit</a>
                <a href="{{ url("/posts/{$post->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">No post available.</td>
        </tr>
    @endforelse
    </tbody>
</table>
</div>


<div class="text-center">
    {!! $posts->appends(['search'=>Request::input('search')])->links() !!}


</div>
