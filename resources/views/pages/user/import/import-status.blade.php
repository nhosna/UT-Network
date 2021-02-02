@extends('layouts.panel')

@section('panelbread')
    {{ Breadcrumbs::render('user.import' ) }}

@endsection

@section('panelhead')
    <h2> Import Users</h2>
@endsection
@section('panelbody')

                     @if(count($errors)===0)
                            Data imported successfully.
                        @else
                            The following rows could not be imported.

                            <div class="table-responsive" style="overflow-x: auto ">

                            <table class="table">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                            </tr>
                            </thead>
                            <tbody  >

                            @foreach( $errors as $index=> $error)

                                <tr>
                                    <td>{{$invaliddata[$index]['first_name']}}</td>
                                    <td>{{$invaliddata[$index]['last_name']}}</td>
                                    <td>{{$invaliddata[$index]['email']}}</td>
                                    <td>{{$invaliddata[$index]['password']}}</td>
                                    <td>{{$invaliddata[$index]['role']}}</td>
                                </tr>
                                <tr class="table-secondary" >
                                    <td  > {{$error->first('first_name')}}   </td>
                                    <td>{{$error->first('last_name')}}</td>
                                    <td>{{$error->first('email')}}</td>
                                    <td>{{$error->first('password')}}</td>
                                    <td>{{$error->first('role')}}</td>
                                </tr>


                               @endforeach
                            </tbody>
                            </table>
                            </div>

                        @endif







@endsection
