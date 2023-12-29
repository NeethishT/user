<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        return [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:cms_users,email,'.request()->id,
            'username' => 'required|unique:cms_users,username,'.request()->id,
            'password_confirmation' => 'required',
            'password' => 'required|confirmed|min:6',
            'roles' => 'required'
        ];
    }
}
