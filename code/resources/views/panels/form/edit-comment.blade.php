



@if($type==='comment')
 {!! Form::open(['method'=>'PUT','url' =>"/comments/$id" ,'class'=> "form-horizontal",'role'=>'form' ,'name'=>'edit-group' ]) !!}

@elseif($type=='reply')
    {!! Form::open(['method'=>'PUT','url' =>"/replies/$id" ,'class'=> "form-horizontal",'role'=>'form' ,'name'=>'edit-group' ]) !!}

@endif



  <div class="row justify-content-between"    >
     <div class="col-8 form-group"  >

             {!! Form::text('body',  $body , ['class' => 'form-control rtl-text', 'rows' => 1 ,'required', 'maxlength'=>255  ]) !!}


     </div>
     <div class="col-2 form-group">
         <button type="submit" class="btn btn-primary">
             Save
         </button>
     </div>



 </div>






 {!! Form::close( ) !!}
