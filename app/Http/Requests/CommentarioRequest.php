<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentarioRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commentario' => ['required', 'min:3', 'max:1000'],
        ];
    }
}
