

<div class="form-group row ">


    <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2   col-xs-8 col-xs-offset-2 ">
        <div class="table-responsive " style="overflow-x: auto ">

            <table class="table  ">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Member</th>
                    <th>Admin</th>
                </tr>
                </thead>

                <tbody  >

                @forelse ($users as $user)



                    <tr>
                        <td><a href="/users/{{$user->id}}">{{$user->first_name  }} {{$user->last_name}}</a></td>
                        <td>{{ $user->email }}</td>

                            <td>

                                <label class="check-container">
                                    <input   type="checkbox" class="form-check-input" name="members[]"   value="{{$user->id}}"   {{ !Session::has('status')  ?($user->is_admin===0 ?'checked':''):  (Session::get("status")[$user->id] ===0 ?'checked':'') }}/>
                                    <span class="checkmark"></span>
                                </label>
                            </td>

                            <td>

                                <label class="check-container">

                                    <input   type="checkbox" class="form-check-input" name="admins[]"   value="{{$user->id}}"   {{ !Session::has('status')  ?($user->is_admin===1 ?'checked':''):  (Session::get("status")[$user->id] === 1?'checked':'') }}/>
                                    <span class="checkmark"></span>
                                </label>
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

            {{$users-> appends(array('first' => Request::input('first'),'last' => Request::input('last') )) ->links()}}

        </div>

    </div>
</div>

