<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();

        if ( ! $user) {
            return false;
        }

        if ($user->can('create-team')) {
            if ($user->hasRole('captain')) {

                //Если уже создавал команду, то нельзя больше
                if ( ! $user->team) {
                    return true;
                }

                return false;
            }

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
            'name' => 'required|max:255|unique:teams',
            'discipline' => 'required|exists:disciplines,id'
        ];
    }
}
