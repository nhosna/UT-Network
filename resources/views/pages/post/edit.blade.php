

@extends('layouts.panel')

@section('panelbread')
    {{ Breadcrumbs::render('post.edit',$post->group,$post ) }}

@endsection


@section('panelhead')
    {{--    @include('components.misc.breadcrumb',['data'=>array('')])--}}
    <h2>
        Edit Post
        <a href="{{ route('post.show',$post->id) }}" class="btn btn-default pull-right"> Back</a>

    </h2>
@endsection


@section('panelbody')

    @include('panels.form.edit-post')

@endsection
