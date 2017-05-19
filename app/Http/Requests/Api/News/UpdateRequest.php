<?php

namespace App\Http\Requests\Api\News;

use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$user = auth('api')->user()) {
            return false;
        }

        if (!$user->can('create-news')) {
            return false;
        }

        if (!$id = $this->route('id')) {
            return false;
        }

        $news = News::find($id);

        if ($news->user_id !== $user->id && !$user->can('edit-news')) {
            return false;
        }

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
            'name' => 'required|string',
            'content' => 'required|string',
            'image' => 'file|mimes:jpeg,bpm,png,jpg'
        ];
    }
}
