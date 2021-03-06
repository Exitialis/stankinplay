<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationPost extends FormRequest
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
            'login' => 'required|max:255|unique:users,login',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'middle_name' => 'required|max:255',
            'group_id' => 'required|exists:groups,id',
            'discipline' => 'required|exists:disciplines,id'
        ];
    }
}
