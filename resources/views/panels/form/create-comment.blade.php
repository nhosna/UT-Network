{!! Form::open(['url' => "/posts/$post_id/comment", 'name'=>'commentform','data-value'=> $post_id ,'onsubmit'=>'submitComment(this,event)'  ]) !!}


<div class="row justify-content-between mt-5"  >

    <div class="col-8   form-group  "  >

            {!! Form::text('body', null, ['class' => 'form-control rtl-text', 'rows' => 1 ,'maxlength'=>255  ,'required'  ]) !!}



    </div>
    <div class="col-2 form-group">
        <button type="submit" class="btn btn-primary  r">
            Comment
        </button>
    </div>


</div>


{!! Form::close() !!}


