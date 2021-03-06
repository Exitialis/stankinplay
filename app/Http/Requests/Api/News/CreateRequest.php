<?php

namespace App\Http\Requests\Api\News;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( ! $user = auth('api')->user()) {
            return false;
        }

        if ($user->can('create-news')) {
            return true;
        }

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
            'name' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|mimes:jpeg,bpm,png,jpg',
        ];
    }
}
