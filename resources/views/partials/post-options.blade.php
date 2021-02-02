<div class="dropdown show pull-right">
    <button class="btn btn-secondary dropdown-toggle" style=" color: black;background-color: transparent; border-color: transparent;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        {!! Form::open(['method'=>'get','url' =>"/posts/$post->id/edit" ,'class'=> "form-horizontal",'role'=>'form' ,'name'=>'edit-group' ]) !!}
            <input type="submit" class="dropdown-item" value="Edit" >
        {!! Form::close( ) !!}

        <a class="dropdown-item" href="{{ url("/posts/{$post->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" >Delete</a>
    </div>
</div>


