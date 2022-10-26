
    {!! Form::open(['method'=>'PUT','url' =>"/users/$user->id" ,'class'=> "form-horizontal",'role'=>'form'   ]) !!}



               <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('FirstName') }}</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name" autofocus>

                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>



                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('LastName') }}</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email }}" required autocomplete="email" {{Auth::user()->can('updateAny','App\User')?'':'readonly'}}>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @if(Auth::user()->id==$user->id)
                    <a href="{{ url('/changepassword') }}" class="  pull-right"> Change Password</a>
                    @endif


    {{--                <div class="form-group row">--}}
{{--                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required     autocomplete="new-password">--}}

{{--                        @error('password')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $message }}</strong>--}}
{{--                        </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}



                @can('updateAny','App\User')
                    @include('panels.form.edit-role')
                @endcan

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </div>



  {!! Form::close( ) !!}


