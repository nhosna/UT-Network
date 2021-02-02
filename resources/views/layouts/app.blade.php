<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{asset('css/css-file-icons.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};


    </script>

    <style>

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }



    </style>

    @stack('styles')
</head>



<body style="background-color: rgba(0, 0, 0, 0.125) ">

<div id="app" >



    <nav class="navbar navbar-default navbar-fixed-top"  >

        <div class="container" >
            <div class="navbar-header" style="width:100%">

                @guest

                <div class="nav navbar-nav navbar-right">

                        <div class="grid-container " style="padding-bottom: 0 ">
                            <div class="grid-item" style="padding-left:5px;padding-right: 5px" >
                                <h5>
{{--                                    <a   style="     color: #636b6f;padding: 0 10px;font-size: 13px; font-weight: 600;letter-spacing: .1rem; text-decoration: none;text-transform: uppercase;" href="{{ route('login') }}">Login</a>--}}
                                    <a    class="links" href="{{ route('login') }}">Login</a>

                                </h5>
                            </div>

                            <div class="grid-item" >
                                <h5>
{{--                                    <a   style="     color: #636b6f;padding: 0 10px;font-size: 13px; font-weight: 600;letter-spacing: .1rem; text-decoration: none;text-transform: uppercase;" href="{{ route('register') }}">Register</a>--}}
                                    <a   class="links" href="{{ route('register') }}">Register</a>
                                </h5>
                            </div>
                        </div>


                </div>

                @endguest



                @auth

                    @include (  'partials.sidebar-menu')



                    @endauth

            </div>




        </div>







    </nav>



    <div id='center' class="main center" >
        <div class="container">
            <div class="row">
                @include('flash::message')
            </div>


        </div>


        @yield('content')


    </div>




</div>






<!-- Scripts -->


</body>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="{{asset('js/arrive.min.js')}}"></script>
<script src="{{ asset('js/scripts/user-avatar.js') }}"></script>

<script src="{{ asset('js/scripts/rtl.js') }}"  ></script>


@stack('scripts')



</html>
