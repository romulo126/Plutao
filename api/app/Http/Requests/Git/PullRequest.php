<?php

namespace App\Http\Requests\Git;

use Illuminate\Foundation\Http\FormRequest;

class PullRequest extends FormRequest
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
            'path' => ['required', 'string', 'max:255'],
            'branche' => ['required', 'array', 'max:255']
        ];
    }
}
