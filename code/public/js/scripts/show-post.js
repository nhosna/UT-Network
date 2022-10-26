

//used inside comment-btn.php

function enableComment(self,post  ){



    $.ajax({
            url: '/view',
            type: 'get',
            dataType: 'json',
            data: {'view':'panels.form.create-comment','param': {'post_id':post}  },

            success: function (data) {
                // console.log(data.data);


                $('#comment-box').replaceWith(data.data)
                // $(self).replaceWith(data.data);
                $(self).remove();

            },


            error: function (xhr) {
                // console.log(xhr.responseText); // this line will save you tons of hours while debugging
                // do something here because of error
            }
        }
    );


}

//used in more-replies.php
function updateCommentOffset(comment_id,count){



    let comment=document.getElementById('acomment_'+comment_id);
    let replies_count=parseInt(comment.getAttribute('data-offset'));
    comment.setAttribute('data-offset',replies_count+count);



}

//used in more-replies.php
function loadReplies(self){

    let comment=$(self).attr('data-value');
    let replies_count=parseInt(document.getElementById('acomment_'+ comment).getAttribute('data-offset'));

    // console.log(comment);






    $.ajax({
            url: '/comments/'+ comment+'/replies',

            type: 'get',
            dataType: 'json',
            data: {'offset':replies_count  },

            success: function (data) {
                // console.log(data.data);

                if(data.count===0){
                    $(self).attr('hidden',true);

                }else{
                    $("#reply-container[data-id='"+comment+"']"). append (data.data  ) ;
                    updateCommentOffset(comment,data.count);


                }


            },


            error: function (xhr) {
                // console.log(xhr.responseText); // this line will save you tons of hours while debugging
            }
        }
    );



}

//used in reply-btn.php

function enableReply(self,comment_id,replyable_type,replyable_id,replyable_user ){

    $.ajax({
            url: '/view',
            type: 'get',
            dataType: 'json',
            data: {'view':'panels.form.create-reply','param': {'replyable_id':replyable_id,'replyable_type':replyable_type,'comment':comment_id,'replyable_user':replyable_user}  },

            success: function (data) {
                // console.log(data);
                $(self).replaceWith(data.data);

            },


            error: function (xhr) {
                // console.log(xhr.responseText);
            }
        }
    );

}


//used in show-post.php

function makeVoteEditable(self,id,value,body,votetype,post_id,poll){



    $.ajax({
            url: '/view',
            type: 'get',
            dataType: 'json',
            data: {'view':'panels.form.edit-vote','param': {'body':body,'id':id,'type': votetype,'value':value,'post_id':post_id,'poll':poll }  },

            success: function (data) {

                // $("#commentbody_"+comment_id).replaceWith(data.data);
                $("#votebody_"+id).html(data.data);


            },


            error: function (xhr) {
                // console.log(xhr.responseText); // this line will save you tons of hours while debugging
                // do something here because of error
            }
        }
    );



}



//used in show-post.php

function makeCommentEditable(self,body, id,type){


    $.ajax({
            url: '/view',
            type: 'get',
            dataType: 'json',
            data: {'view':'panels.form.edit-comment','param': {'body':body,'id':id ,'type':type}  },

            success: function (data) {
                // console.log(data);



                if(type==='reply'){

                    $("#replybody_"+id).html(data.data);

                }else if(type==='comment'){

                    $("#commentbody_"+id).html(data.data);

                }

            },


            error: function (xhr) {
                // console.log(xhr.responseText); // this line will save you tons of hours while debugging
                // do something here because of error
            }
        }
    );




}
//used in show-post.php
function removeCollapse(self){
    $(self).remove();
}


//used in create-comment.php
function submitComment(self,event) {

    event.preventDefault();

    var fd = new FormData(self);
    let post=$(self).attr('data-value');
    $(self).children().find("input[type='text']").val('');


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            url: $(self).attr('action'),

            type: 'POST',
            dataType: 'json',
            data: fd,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data);
                $("#comment-container[data-id='"+ post+"']"). prepend (data.data  ) ;

                $("#zero-comments").remove();

            },


            error: function (xhr) {
                // console.log(xhr.responseText);
            }
        }
    );



}



//used in create-reply.php

function submitReply(self,event){


    event.preventDefault();
    $data= JSON.parse($("input[name='data']").val ());

    var fd = new FormData (self);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            url: $(self).attr('action'),

            type: 'POST',
            dataType: 'json',
            data: fd,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data);



                $('#replyto_'+$data['comment_id']+'_'+$data['reply_id']).html(data.replybutton);
                $('#morereplies_'+$data['comment_id']).attr('hidden',false);


            },


            error: function (xhr) {
                // console.log(xhr.responseText);
            }
        }
    );

}

