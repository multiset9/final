<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'email' => 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:6|max:20',
            'first_name'=> 'required|string|max:20',
            'last_name' => 'required|string|max:40',
            'country'=>'required|string|max:100',
            'city'=>'required|string|max:100',
            'phone' => 'required|max:30',
            'role_id' =>'required|in:1,2'
        ];
    }
}
