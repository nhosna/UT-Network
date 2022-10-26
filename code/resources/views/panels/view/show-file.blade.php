


<div  class="panel panel-default">
    <div  class="panel-heading">
        Attachments
    </div>

    <div class="panel-body"  id="uploadedfiles" data-value="{{$post->id}}">


@foreach($post->files as $file)


     <div class="row">
         <div class="col-6" style="text-align: center">
             @if(in_array ($file->extension ,['jpeg','jpg','gif','png']))
                 <a href='/{{$file->path}}' style='text-align: center' > <img id='image_"+id+"'  style='width:100px '  class=' img-thumbnail'  src='/{{$file->path}}'   alt='' /> </a>
             @else
                 <a href='/{{$file->path}}' class='fi fi-{{$file->extension}}'    download><div class='fi-content'>{{$file->extension}}</div></a>
             @endif
         </div>
         <div class="col-6">
             <h4>{{$file->display_name}}</h4>
         </div>
     </div>


@endforeach



    </div>
</div>
