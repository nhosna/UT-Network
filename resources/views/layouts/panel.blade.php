@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                @yield('panelbread')


                <div class="panel panel-default">
                    <div class="panel-heading">

                        @yield('panelhead')
                    </div>

                    <div class="panel-body"   >
                        @yield('panelbody')
                    </div>
                </div>
                <div class="panel panel-default" style="background-color: transparent">

                        @yield('panelend')

                </div>

            </div>



        </div>
    </div>



@endsection
