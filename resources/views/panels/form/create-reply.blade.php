{!! Form::open(['url' => "/comments/$comment/reply" ,'name'=>'replyform','onsubmit'=>'submitReply(this,event)'  ]) !!}


<input type="hidden" name="data" value='{"comment_id":{{$comment}},"reply_type":"{{$replyable_type}}","reply_id":{{$replyable_id}},"reply_user":{{$replyable_user}} }'/>


<div class="row justify-content-center"  >
    <div class="col-8 form-group "  >
            {!! Form::text('body', null, ['class' => 'form-control  rtl-text ', 'rows' => 1 ,'required' ,'maxlength'=>255 ]) !!}

    </div>
    <div class="col-1 form-group  ">
        <input type="submit" class="btn btn-primary " value="Reply"/>

    </div>
</div>

{!! Form::close() !!}

