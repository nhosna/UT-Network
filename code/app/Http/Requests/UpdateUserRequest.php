<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'first_name' => 'required|regex:/^[A-Za-z][A-Za-z0-9]*$/',
            'last_name' => 'required|regex:/^[A-Za-z][A-Za-z0-9]*$/',
            'email' => 'required|email|regex:/(.*)ut\.ac\.ir$/',

        ];



    }
}
