
var filtered=[];

var MAXFILESIZE=20;


window.onbeforeunload=function (e){

    let upload_btn=document.getElementById('upload');
    event = e || window.event;
    $(window).unbind();
    if(upload_btn.disabled){

        return undefined
    }else{
        return true;

    }



}


function deleteUploadedFile(self,id){




    if(confirm('Are you sure you want to delete this file?')){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(
            {
                url: "/files/"+id,
                method: 'DELETE', // replaced from put
                dataType: "JSON",
                data: {
                    "id": id // method and token not needed in data
                },
                success: function (data)
                {  $message=$('#message');
                    // console.log(data); // see the reponse sent
                    $message.css('display', 'block');
                    $message.html(data.message);
                    $message.removeClass().addClass('alert').addClass(data.class_name);


                },
                error: function(xhr) {
                    // console.log(xhr.responseText); // this line will save you tons of hours while debugging
                    // do something here because of error
                }
            });


        deleteFile(self);


    }


}

$(document).ready(function(){





    $('#upload_form').on('submit', function(event){


        event.preventDefault();


        var allfiles='select_file[]';

        var fd = new FormData(this);
        fd.delete(allfiles);



        [].forEach.call(filtered, function (data) {
            if(data['file']!==undefined && data['fileid']===undefined){
                fd.append('select_file[]', data['file']);

            }

        });

        // // demonstrate that the entire form has been attached
        // for (var key of fd.keys()) {
        //     console.log(key, fd.getAll(key));
        // }
        // for (var key of filtered.keys()) {
        //     console.log(key, filtered[key]);
        // }


        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        //Do something with upload progress here
                        // console.log(percentComplete);

                        $(".progress-bar").css({'width': percentComplete + '%','display':'block'});
                        $(".progress-bar").html(   percentComplete + '%' );



                    }

                    xhr.addEventListener("load", function(evt){

                        $(".progress-bar").css({'width': 0 + '%','display':'none'});


                    }, false);

                }, false);


                return xhr;
            },

            url:"/files",
            method:"POST",
            data:fd,
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {

                $message=$('#message');

                $message.css('display', 'block');
                $message.html(data.message);
                $message.removeClass().addClass('alert').addClass(data.class_name);


                changeFileRows(data.file_ids);

                addFileIds(data.file_ids  );
                attachFileIds(data.file_ids);





            },



            error: function(xhr) {
                // console.log(xhr );


                // do something here because of error
            }
        })

        disableUploadButton();


    });






});

function attachFileIds(file_ids){


    let post_form=document.getElementById('post-create');


    for(let i=0;i<file_ids.length;i++){

        post_form.insertAdjacentHTML('afterbegin',' <input type="hidden" name="fileid[]" id="file_'+file_ids[i]+'" value="'+file_ids[i]+'" /> ');


    }



}

function changeFileRows(file_ids){



    let i=0;

    filtered.forEach((data,index)=> {
        if (data !== undefined && data['fileid']===undefined  )
        {
            let row=document.getElementById('row_'+index)
            // row.className='table-secondary';


            let del_btn=document.getElementById('del_'+index);
            let display_input=document.getElementById('display_'+index);



            del_btn.outerHTML= "<i class='fa fa-trash' onclick='deleteUploadedFile(this,"+file_ids[i]+")' style='cursor:pointer' id='del_"+index+"'  > </i>"   ;
            display_input.outerHTML ="<p>"+display_input.value+"</p>"


            i++;

        }

    });





}


//adds file ids of uploaded files to their rows
function addFileIds(file_ids ){

    let i=0;


    filtered.forEach((data,index)=> {

        if (data !== undefined && data['fileid'] === undefined) //data==undefined>>removed | data['file']==undefined >>uploaded but does not have file id
        {
            filtered[index]['fileid'] = file_ids[i];
            i++;

        }

    } );




}

function addCell(data,row,col){
    // alert(row+" "+col);

    var table = document.getElementById('upload-table');
    var body=table.getElementsByTagName('tbody')[0];
    body.rows[row-1 ].cells[col].innerHTML=data;


}
function addRow(data,index) {
    var table = document.getElementById('upload-table');
    var body=table.getElementsByTagName('tbody')[0];


    let n=body.rows.length;

    var x = body.insertRow(0);


    body.rows[0].setAttribute('id','row_'+index);

    var e = body.rows.length-1;
    var l = body.rows[e].cells.length;

    for (var c=0, m=l; c < m; c++) {
        body.rows[0].insertCell(c);
        body.rows[0].cells[c].innerHTML =data[c];
    }
}

function addColumn() {
    var table = document.getElementById('upload-table');
    for (var r = 0, n = table.rows.length; r < n; r++) {
        table.rows[r].insertCell(0);
        table.rows[r].cells[0].innerHTML = text;
    }
}

function deleteRow(index) {
    $('#row_'+index).remove();




    for(let i=0;i<filtered.length;i++) {
        let data=filtered[i];


        if (data !== undefined && data['fileid'] === undefined) //data==undefined>>removed | data['file']==undefined >>uploaded but does not have file id
        {
            return;

        }

    }

    disableUploadButton();



}

function deleteColumn() {
    var table = document.getElementById('upload-table');
    for (var r = 0, n = table.rows.length; r < n; r++) {
        table.rows[r].deleteCell(0); // var table handle
    }
}



function getFileInfo(file  ) {



    let suffix = "bytes";
    let size = file.size;
    if (size >= 1024 && size < 1024000) {
        suffix = "KB";
        size = Math.round(size / 1024 * 100) / 100;
    } else if (size >= 1024000) {
        suffix = "MB";
        size = Math.round(size / 1024000 * 100) / 100;
    }


    let data={
        "name": file.name,
        "size": size,
        "suffix": suffix,

    };

    return data;


}

function disableUploadButton(){
    let upload_btn=document.getElementById('upload');
    upload_btn.disabled=true;

}
function enableUploadButton(){
    let upload_btn=document.getElementById('upload');
    upload_btn.disabled=false;

}

function getExtension(filename){

    var extension = filename.replace(/^.*\./, '');

    if (extension === filename) {
        extension = '';
    } else {
        extension = extension.toLowerCase();
    }
    return extension;

}

function addFileDescription(index,img, display_input,size_str,del_btn){


    // let progress_bar='<div class="progress"> <div class="progress-bar" id="progress_'+index+'" role="progressbar" style="width: 0%"           aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>'



    addRow([  img, display_input,size_str , del_btn ],index);


}

function determineFileType (extension){


    if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg") {
        return 'image';
    }
    else{
        return 'fi'

    }


}


function validateFileSize(size){


    if(size>1024000*MAXFILESIZE)
        return false;
    return true;




}

function onInputChange(self) {

    enableUploadButton()

    var countFiles = $(self)[0].files.length;
    var imgPath = $(self)[0].value;


    var files=$(self)[0].files;



    for (let i=0;i<$(self)[0].files.length;i++){
        filtered.push(

            {
                'fileid':undefined,
                'file':$(self)[0].files[i],

            });

    }




    let offset=filtered.length - files.length  ;

    for (let i = 0; i < countFiles; i++) {

        let index=offset+i;

        if(!validateFileSize(files[i].size)){


            // let d='<div  class="alert alert-warning" style="display: block">'+files[i].name+': File size cannot be larger than '+MAXFILESIZE+'MB.</div>';

            $message=$('#message');
            $message.css('display', 'block');
            $message.html( files[i].name+': File size cannot be larger than '+MAXFILESIZE+'MB');
            $message.removeClass().addClass('alert').addClass('alert-warning');


            delete filtered[index];

            continue;



        }

        var filename = files[i].name ;

        let extension=getExtension(filename);
        let filetype = determineFileType (extension);



        let data=getFileInfo(files[i]);
        let del_btn="  <i  class='fa fa-remove'  id='del_"+(i+offset)+"' style='cursor:pointer' onclick='deleteFile(this)' > </i> ";
        let display_input="<input type='text' class='form-control' name='display_name["+index+"]' value='"+data['name']+"' id='display_"+(i+offset)+"' />"
        let size_str=data['size']+''+data['suffix'];



        switch (filetype) {


            case('image'): {

                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {

                        let img= "<figure style='text-align: center;width:100px'> <img  id='image_"+index+"'  class='  img-thumbnail' src='"+e.target.result +" ' alt=''/> <figcaption> "+data['name']+"</figcaption> </figure>"
                        addFileDescription(index,img ,display_input,size_str,del_btn );

                    }

                    reader.readAsDataURL($(self)[0].files[i]);

                }
                else {
                    alert("This browser does not support FileReader.");
                }
                break;


            }
            case('fi'): {

                let img="  <figure style='text-align: center;width:100px'> <div  class='fi fi-"+extension +"'><div class='fi-content'>" +extension+"</div></div> <figcaption> "+data['name']+"</figcaption> </figure>"
                addFileDescription(index,img ,display_input,size_str,del_btn );
                break;


            }


        }



    }



}



function deleteFile(self){

    var id = self.id.replace(/del_/, '');

    delete filtered[parseInt(id)];

    deleteRow(id);

}
function addInput(obj) {
    $("#input-files").prepend("  <input type='file' name='select_file[]' id='select_file' class=\"custom\" onclick='addInput(this)' onchange='onInputChange(this)' multiple  />");



}

