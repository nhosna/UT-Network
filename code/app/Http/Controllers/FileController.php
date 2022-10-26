<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use     Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Str;

class FileController extends Controller
{


    function store(FileRequest $request)
    {


        $fileIds=[];


        if ($request->hasFile('select_file')) {

            $i = 0;


            $validation = Validator::make($request->all(),
                ['select_file.*' => 'required',

                    ]);
            if ($validation->passes()) {


                foreach ($request->select_file as $file) {

                    while (!array_key_exists($i, $request->display_name)) {

                        $i = $i + 1;

                    }


                    $extension = FileFacade::extension($file->getClientOriginalName());
                    $fileName = Str::slug($file->getClientOriginalName()) . '_' . time() . '_'.auth()->user()->id.'.' . $extension;


                    $file->move(public_path('uploads'), $fileName);
                    $filePath = "uploads/" . $fileName;

                    $newfile = File::create([
                        'file_name' => $fileName, //eg screenshot.png
                        'path' => $filePath, //eg images/skljdfkslf.png
                        'display_name' => $request->display_name[$i], //eg my screenshot
                        'extension'=>$extension


                    ]);


                    $newfile->save();
                    $fileIds[] = $newfile->id;

                    $i = $i + 1;


                }
                return response()->json([
                    'message' => 'File(s) Uploaded Successfully',
                    'class_name' => 'alert-success',
                    'file_ids'=>$fileIds,

                ]);


            }

            else{


                return response()->json([
                    'message'   => $validation->errors()->all(),
                    'class_name'  => 'alert-danger'
                ]);
            }


        }
        return response()->json([
            'message'   => 'No file found',
            'class_name'  => 'alert-danger'
        ]);


    }


    //delete a file

     public function destroy( File  $file){

         FileFacade::delete($file->path);

         $file->delete();

         return response()->json([
            'message' => 'File deleted Successfully',
            'class_name' => 'alert-success',


        ]);


    }








}


