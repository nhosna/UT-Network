@extends('layouts.panel')

@section('panelbread')
    {{ Breadcrumbs::render('user.import' ) }}

@endsection

@section('panelhead')
    <h2>Import Users</h2>

@endsection
@section('panelbody')

    <p>
        Please upload a <b>CSV</b> file with columns similar to the table below.
        <br/>
        Note: The role column can be one of "user", "admin", "super".
    </p>

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


            <tr>
                <td>Akbar</td>
                <td>Akbari</td>
                <td>akbar@ut.ac.ir</td>
                <td>password123</td>
                <td>admin</td>
            </tr>


    </table>

    </div>


    <form class="form-horizontal" method="POST" action="{{ route('user.importparse') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">

            <div class="col-md-6 col-md-offset-3">


                <div class="custom-file">

                    <input type="file" class="custom-file-input" id="csv_file"  name="csv_file">
                    <label class="custom-file-label" for="csv_file">Choose file</label>
                </div>


{{--                    <input type="file"   id="csv_file" name="csv_file" >--}}
{{--                    <label class="custom-file-label" for="csv_file">Choose file</label>--}}
{{--                </div>--}}



                @if ($errors->has('csv_file'))
                    <span class="help-block">
                    <strong>{{ $errors->first('csv_file') }}</strong>
                </span>
                @endif
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary pull-right">
                    Upload
                </button>
            </div>
        </div>
    </form>



    <script>


             $('.custom-file input').change(function (e) {
                 if (e.target.files.length) {
                     $(this).next('.custom-file-label').html(e.target.files[0].name);
                 }

             });


    </script>

@endsection
