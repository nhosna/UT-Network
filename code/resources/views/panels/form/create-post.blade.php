


{{ Form::open(['url' => route('post.store',$group->id), 'class' => 'form-horizontal', 'role' => 'form','files'=>'true','id'=>'post-create' ]) }}


        <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', 'Title', ['class' => 'col-md-2  col-sm-3 control-label']) !!}

            <div class="col-md-8 col-sm-8">
                {!! Form::text('title', null, ['class' => 'form-control rtl-text' , 'required', 'autofocus']) !!}

                <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
            </div>
        </div>

        <div class="form-group row{{ $errors->has('body') ? ' has-error' : '' }}">
            {!! Form::label('body', 'Body', ['class' => 'col-md-2 col-sm-3 control-label']) !!}

            <div class="col-md-8 col-sm-8">
                {!! Form::textarea('body',  null, ['class' => 'form-control rtl-text', 'required']) !!}

                <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
            </div>
        </div>

        <div class="form-group row {{ $errors->has('vote_type') ? ' has-error' : '' }}">
            <label class="col-md-2 col-sm-3 control-label">Vote Type </label>
            <div class="col-md-8 col-sm-8" >
                @include('partials.set-vote-type')
            </div>
            <span class="help-block">
            <strong>{{ $errors->first('vote_type') }}</strong>
        </span>
        </div>


        <div id="poll-container" style="display: none">

            <div class="form-group row {{ $errors->has('poll') ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 control-label">Poll</label>
                <div class="col-md-8 col-sm-8">
                    @include('panels.form.create-poll')

                </div>
                <span class="help-block">
                <strong>{{ $errors->first('poll') }}</strong>
                </span>
            </div>


        </div>


        <div class="form-group row {{ $errors->has('datetime') ? ' has-error' : '' }}">
            <label class="col-md-2 col-sm-3 control-label">Expiration Date and Time</label>
            <div class="col-md-8 col-sm-8">
                @include('partials.set-expiration')
            </div>
            <span class="help-block">
            <strong>{{ $errors->first('datetime') }}</strong>
        </span>
        </div>



        <div class="form-group row ">
            <div class="col-md-10 col-sm-10"></div>
            <div class="col-md-2 col-sm-2     ">
                <button type="submit" class="btn btn-primary">
                    Create
                </button>
            </div>
        </div>



        {!! Form::close() !!}


        <div class="form-group row ">
            <label class="col-md-2  control-label">Upload Attachment </label>
            <div class="col-md-8">
                @include('panels.form.upload-file')
            </div>
        </div>


@push('scripts')
    <script src="{{ asset('js/scripts/create-post.js') }}" type="text/javascript"></script>

{{--    <script>--}}
{{--        function linkify(str) {--}}
{{--            var newStr = str.replace(/(<a href=")?((https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)))(">(.*)<\/a>)?/gi, function () {--}}

{{--                return '<a href="' + arguments[2] + '">' + (arguments[7] || arguments[2]) + '</a>'--}}
{{--            });--}}
{{--            console.log(newStr)--}}
{{--            $('div').html(newStr); //fill output area--}}
{{--        }--}}

{{--        $(document).ready(function () {--}}
{{--            var data = $('div').html(); //get input (content)--}}
{{--            linkify(data); //run function on content--}}

{{--        });--}}



{{--    </script>--}}
@endpush
