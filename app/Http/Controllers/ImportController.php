<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\CsvData;
//use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

//use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    private static $fields=[
        'first_name',
        'last_name',
        'email',
        'password',
        'role'

    ];

    public function getImport()
    {
        return view('pages.user.import.import-file');
    }

    public function parseImport(Request $request)
    {


        $validator = $this->validator($request->all());
        if($validator->fails())
        {
            return back()->withErrors($validator->getMessageBag());
        }

        $path = $request->file('csv_file')->getRealPath();


        $data = array_map('str_getcsv', file($path));


        if (count($data) > 0) {

            $csv_data = array_slice($data, 0, 1);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        $db_fields=self::$fields;


        return view('pages.user.import.import-fields', compact(  'db_fields','csv_data', 'csv_data_file'));

    }

    public function processImport(Request $request)
    {
        if($request->fields)

        $data = CsvData::find($request->csv_data_file_id);

        if(is_null($data)){
               return view('pages.user.import.import-file');
        }

        $csv_data = json_decode($data->csv_data, true);

        $errors=[];



        foreach ($csv_data as $i =>$row) {
            $user = new User();

            $json=[];

            foreach (self::$fields as $index => $field) {
                $json[$field]=$row[$request->fields[$index]];
            }


            $validator = $this->dataValidator($json);
            if($validator->fails())
            {

                $errors[]=$validator->getMessageBag();
                $invaliddata[]=$json;

                continue;
            }

            foreach (self::$fields as $index => $field) {


                    if($field==='password'){

                        $user->$field =Hash::make($row[$request->fields[$index]]) ;

                    }else{

                        $user->$field = $row[$request->fields[$index]];

                    }

            }
            $user->save();
        }


        CsvData::truncate();

        return view('pages.user.import.import-status',compact('errors','invaliddata')) ;
    }

    protected function validator(  $data)
    {
        return Validator::make(
        $data

          , [

        'csv_file' => 'required|file'

        ]);
    }


    protected function dataValidator( array $data){


        $rules = [];


        $allowedroles=['admin','super','user'];

        $rules['first_name'] = 'required|regex:/^[A-Za-z][A-Za-z0-9]*$/';
        $rules['last_name'] = 'required|regex:/^[A-Za-z][A-Za-z0-9]*$/';
        $rules['email'] = 'required|email|unique:users,email|regex:/(.*)ut\.ac\.ir$/';
        $rules['password'] = 'required';
        $rules['role'] = 'required|'. Rule::in($allowedroles);


        return  Validator::make($data,
            $rules

        );



    }



}
