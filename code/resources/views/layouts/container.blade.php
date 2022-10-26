@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12">
                @yield('containerbread')

            <div class="panel panel-default " style="background-color: transparent">
{{--            <div class="panel panel-default "  >--}}


{{--                <div class="panel-body"   >--}}
                    @yield('containercontent')

{{--                </div>--}}

            </div>
            </div>



        </div>
    </div>



@endsection
