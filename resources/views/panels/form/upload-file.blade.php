

<div class="panel panel-default">

    <div class="panel-body">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div id="messages">
            <div class="alert" id="message" style="display: none"></div>
        </div>


       <span class="loader"></span>
        <form method="post" id="upload_form" enctype="multipart/form-data">



            {{ csrf_field() }}



            <div class="card">
                <div class="card-body">

                    <table  id='upload-table'  class="table" >
                        <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Display Name</th>
                            <th>Size</th>

                            <th>Delete</th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr hidden>
                            <td>&nbsp;</td>
                            <td  >&nbsp;</td>
                            <td  >&nbsp;</td>

                            <td></td>
                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <div > <div class="progress-bar   " id="progress" role="progressbar" style="width: 0"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"> </div></div>

                        </tr>


                        </tfoot>

                    </table>
                </div>
            </div>



            <span class="hiddenFileInput pull-right"   id="input-files">
                <input type='file' name='select_file[]' id='select_file'   onclick='addInput(this)' onchange='onInputChange(this)' multiple  />
            </span>

            <input type="submit" name="upload" id="upload" class="btn btn-primary pull-right" value="Upload" disabled >



        </form>

    </div>



</div>


@push('scripts')
    <script src="{{ asset('js/scripts/upload-file.js') }}" type="text/javascript"></script>

@endpush
