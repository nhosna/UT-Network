
{!! Form::open(['method'=>'POST','url' => "/users", 'class' => 'form-horizontal', 'role' => 'form']) !!}




<div class="form-group row">
    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('FirstName') }}</label>

    <div class="col-md-6">
        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"   value="{{old('first_name')}}" required   autofocus>

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
        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"  value="{{old('last_name')}}"  required   autofocus>
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
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required   >

        <small   class="form-text text-muted">The email must be in the following format: *.ut.ac.ir</small>


        @error('email')
        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required    >

        @error('password')
        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
        @enderror
    </div>
</div>


<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            Create
        </button>
    </div>
</div>



{!! Form::close( ) !!}


