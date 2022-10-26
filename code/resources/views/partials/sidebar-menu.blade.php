

<style>

    #sidebarMenu {
        height: 100%;
        position: fixed;
        left: 0;
        width: 220px;
        margin-top: 40px;
        transform: translateX(-250px);
        transition: transform 250ms ease-in-out;
        /*background: linear-gradient(180deg, #878787 0%, #e8e8e8 100%);*/
        background-color: #ffffff;

    }
    .sidebarMenuInner{
        margin:0;
        padding:0;
        border-top: 1px solid rgba(255, 255, 255, 0.10);
    }
    .sidebarMenuInner li{
        list-style: none;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        padding: 20px;
        cursor: pointer;
        border-bottom: 1px solid rgba(255, 255, 255, 0.10);
    }
    .sidebarMenuInner li span{
        display: block;
        font-size: 14px;
        color: rgba(0, 0, 0, 0.5);
    }
    .sidebarMenuInner li a{
        color: #131313;
        text-transform: uppercase;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
    }
    input[type="checkbox"]:checked ~ #sidebarMenu {
        transform: translateX(0);
    }

    input[type=checkbox] {
        transition: all 0.3s;
        box-sizing: border-box;
        display: none;
    }
    .sidebarIconToggle {
        transition: all 0.3s;
        box-sizing: border-box;
        cursor: pointer;
        position: absolute;
        z-index: 99;
        top: 22px;
        left: 15px;
        height: 22px;
        width: 22px;
    }
    .spinner {
        transition: all 0.3s;
        box-sizing: border-box;
        position: absolute;
        height: 3px;
        width: 100%;
        background-color: #000000;
    }
    .horizontal {
        transition: all 0.3s;
        box-sizing: border-box;
        position: relative;
        float: left;
        margin-top: 3px;
    }
    .diagonal.part-1 {
        position: relative;
        transition: all 0.3s;
        box-sizing: border-box;
        float: left;
    }
    .diagonal.part-2 {
        transition: all 0.3s;
        box-sizing: border-box;
        position: relative;
        float: left;
        margin-top: 3px;
    }
    input[type=checkbox]:checked ~ .sidebarIconToggle > .horizontal {
        transition: all 0.3s;
        box-sizing: border-box;
        opacity: 0;
    }
    input[type=checkbox]:checked ~ .sidebarIconToggle > .diagonal.part-1 {
        transition: all 0.3s;
        box-sizing: border-box;
        transform: rotate(135deg);
        margin-top: 8px;
    }
    input[type=checkbox]:checked ~ .sidebarIconToggle > .diagonal.part-2 {
        transition: all 0.3s;
        box-sizing: border-box;
        transform: rotate(-135deg);
        margin-top: -9px;
    }
    /*note*/
    /* The side navigation menu */
    .sidenav {
        height: 100%; /* 100% Full-height */
        width: 0; /* 0 width - change this with JavaScript */
        position: fixed; /* Stay in place */
        z-index: 1; /* Stay on top */
        top: 0; /* Stay at the top */
        left: 0;
        background-color: #111; /* Black*/
        overflow-x: hidden; /* Disable horizontal scroll */
        padding-top: 60px; /* Place content 60px from the top */
        transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
    }

    /* The navigation menu links */
    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #555555;
        display: block;
        transition: 0.3s;
    }

    /* When you mouse over the navigation links, change their color */
    .sidenav a:hover {
        color: #f1f1f1;
    }


    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
        #sidebarMenu {padding-top: 15px;}
        #sidebarMenu   a {font-size: 15px;}
    }

</style>



<input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
<label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
</label>


<div  id="sidebarMenu" class="sidenav">
{{--    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>--}}
    <a href="{{ url('users/'.Auth::user()->id) }}">  @include('partials.user-avatar' , ['size'=>'md','first_name'=>Auth::user()->first_name ,'last_name'=> Auth::user()->last_name])</a>


    <a   href="{{ url('users/'.Auth::user()->id) }}">    <i class="fa fa-user"></i> Profile</a>

    <a   href="{{ url('/home') }}">    <i class="fa fa-home"></i> Home</a>

    @can('viewAny','App\Models\Post')
    <a   href="{{ url('/posts') }}">   <i class="fa fa-newspaper-o"></i> Posts</a>
    @endcan

    <a   href="{{ url('/groups') }}">    <i class="fa fa-university"></i> Groups</a>


    @can('viewAny','App\User')
    <a   href="{{ url('/users') }}">    <i class="fa fa-users"></i> Users</a>
    @endcan

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); if(confirm('Are you sure you want to log out?')){document.getElementById('logout-form').submit();} ">
            <i class="fa fa-sign-out"></i>
            Logout
        </a>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>



</div>



{{--<input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">--}}
{{--<label for="openSidebarMenu" class="sidebarIconToggle">--}}
{{--    <div class="spinner diagonal part-1"></div>--}}
{{--    <div class="spinner horizontal"></div>--}}
{{--    <div class="spinner diagonal part-2"></div>--}}
{{--</label>--}}


{{--<div id="sidebarMenu" style="background-color: rgb(255,255,255);overflow-y:auto ;" >--}}
{{--    <div class="panel-group"  style="background-color: rgb(255,255,255);overflow-y:auto ;" >--}}


{{--        <div class="panel panel-default sidebarMenuInner"  style="background-color: rgb(255,255,255);overflow-y:auto ;">--}}


{{--            <div class="panel-heading" style="padding-top:20px;padding-left:50px;" >--}}

{{--               @include('partials.user-avatar' , ['size'=>'md','first_name'=>Auth::user()->first_name ,'last_name'=> Auth::user()->last_name])--}}

{{--            </div>--}}
{{--            <div class="panel-heading" style="padding-top:20px;padding-left:50px;" >--}}

{{--                <h4 class="panel-title" style="font-size:20px" >--}}
{{--                    <i class="fa fa-user"></i>--}}

{{--                    <a   href="{{ url('users/'.Auth::user()->id) }}">Profile</a>--}}
{{--                </h4>--}}
{{--            </div>--}}

{{--            <div class="panel-heading" style="padding-top:20px;padding-left:50px;" >--}}
{{--                <h4 class="panel-title" style="font-size:20px" >--}}
{{--                    <i class="fa fa-home"></i>--}}

{{--                    <a   href="{{ url('/home') }}">Home</a>--}}
{{--                </h4>--}}
{{--            </div>--}}
{{--            @can('viewAny','App\Models\Post')--}}
{{--            <div class="panel-heading" style="padding-top:20px;padding-left:50px;" >--}}
{{--                <h4 class="panel-title" style="font-size:20px" >--}}
{{--                    <i class="fa fa-book"></i>--}}

{{--                    <a   href="{{ url('/posts') }}">Posts</a>--}}
{{--                </h4>--}}
{{--            </div>--}}
{{--            @endcan--}}
{{--            <div class="panel-heading" style="padding-top:20px;padding-left:50px;">--}}

{{--                <h4 class="panel-title" style="font-size:20px">--}}
{{--                    <i class="fa fa-university"></i>--}}
{{--                    <a   href="{{ url('/groups') }}">Groups</a>--}}
{{--                </h4>--}}

{{--            </div>--}}

{{--            @can('viewAny','App\User')--}}

{{--            <div class="panel-heading" style="padding-top:20px; padding-left:50px ;" >--}}
{{--                <h4 class="panel-title" style="font-size:20px">--}}
{{--                    <i class="fa fa-users"></i>--}}

{{--                    <a   href="{{ url('/users') }}">Users</a>--}}
{{--                </h4>--}}
{{--            </div>--}}
{{--            @endcan--}}

{{--            <div class="panel-heading" style="padding-top:20px; padding-left:50px ;" >--}}
{{--                <h4 class="panel-title" style="font-size:20px">--}}
{{--                    <i class="fa fa-dashboard"></i>--}}

{{--                    <a   href="{{ url('/admin/dashboard') }}">Dashboard</a>--}}
{{--                </h4>--}}
{{--            </div>--}}


{{--            <div class="panel-heading" style="padding-top:20px; padding-left:50px ;" >--}}
{{--                <h4 class="panel-title" style="font-size:20px">--}}

{{--                    <i class="fa fa-sign-out"></i>--}}
{{--                    <a href="{{ route('logout') }}"--}}
{{--                       onclick="event.preventDefault();--}}
{{--                         document.getElementById('logout-form').submit();">--}}
{{--                        Logout--}}
{{--                    </a>--}}

{{--                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                        {{ csrf_field() }}--}}
{{--                    </form>--}}
{{--                </h4>--}}
{{--            </div>--}}




{{--        </div>--}}


{{--    </div>--}}
{{--</div>--}}
