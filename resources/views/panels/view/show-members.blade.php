<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <ul class="list-group" >


            @forelse($members as $user)

                <li class="list-group-item row   " >
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <a href="/users/{{$user->id}}" style="color: #555555;">  @include('partials.user-avatar',['size'=>'sm','first_name'=>$user->first_name ,'last_name'=>$user->last_name])</a>
                    </div>

                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <h4 > {{ $user->first_name }} {{ $user->last_name }}</h4>
                        <td> <span class="badge badge-pill badge-primary "  >{{$user->pivot->is_admin?'admin':'' }}</span></td>
                    </div>


                </li>


            @empty

                <li class="list-group-item row  " >
                    <h4>No members available</h4>
                </li>


            @endforelse



        </ul>
        <div class="text-center">

            {!! $members->links() !!}

        </div>


    </div>


    <div class="col-2"></div>


</div>

