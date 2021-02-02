

    <div class="row justify-content-center ">


            <h4 class="col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 col-xs-3 col-xs-offset-2" >
                <b>Name</b>
            </h4>

        <h4 class="col-md-7 col-sm-7 col-xs-7 ">
            {{ $user->first_name }} {{$user->last_name}}

        </h4>
    </div>


    <div class="row justify-content-center">

        <h4 class="col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 col-xs-3 col-xs-offset-2">

            <b>Email</b>

        </h4>
        <h4 class="col-md-7 col-sm-7 col-xs-7">
            {{ $user->email }}

        </h4>
    </div>


    <div class="row justify-content-center">

        <h4 class="col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 col-xs-3 col-xs-offset-2">
            <b>Role</b>

        </h4>
        <h4 class="col-md-7 col-sm-7 col-xs-7">
            {{ucfirst($user->role)}}

        </h4>
    </div>
    <div class="row justify-content-center">

        <h4 class="col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 col-xs-3 col-xs-offset-2">

            <b>Groups</b>

        </h4>
        <div class="col-md-7 col-sm-7 col-xs-7">
            <ul  >
                @foreach( $user->groups as $group)

                 <li >

                           <h5 style="   word-break:break-all;">
                               <a href="{{route('group.feed',$group->id)}}"  >  {{$group->name}}</a>

                           </h5>


                    </li>
                @endforeach

            </ul>

        </div>
    </div>







