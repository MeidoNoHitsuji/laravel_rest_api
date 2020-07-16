<?php

namespace App\Http\Requests\Api\Auth;

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
        return [
            'show_name' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string', 'max:255'],
            'github' => ['required', 'url', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'is_finished' => ['required', 'boolean'],
            'telegram' => ['required', 'string', 'size:11'],
            'phone' => ['required', 'string', 'size:11'],
            'birthday' => ['required', 'date'],
        ];
    }
}
