

@extends('layouts.panel')

@section('panelbread')
    {{ Breadcrumbs::render('auth.changepassword',$user ) }}

@endsection


@section('panelhead')
    <h2>Change Password</h2>
@endsection

@section('panelbody')


            <form action="{{ url('/changepassword') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group row {{ $errors->has('current_password') ? 'has-error' : '' }}">
                    <label for="current_password" class="col-md-4 col-form-label text-md-right">Current password</label>
                    <div class="col-md-6">
                        <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"  placeholder="Current Password" required>

                    @error('current_password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    </div>


                </div>
                <div class="form-group row  {{ $errors->has('new_password') ? 'has-error' : '' }}">

                    <label for="new_password" class="col-md-4 col-form-label text-md-right">New password </label>

                        <div class="col-md-6">
                            <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror"  placeholder="New Password" required>
                            @error('new_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                </div>
                <div class="form-group  row {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                    <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm password </label>

                    <div class="col-md-6">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" placeholder="Confirm Password" required>

                        @error('new_password_confirmation')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    </div>

                </div>
                <div>
                    <input class="btn btn-primary pull-right" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>


@endsection
