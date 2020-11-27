<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersVacationsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    { return true; }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vacations' => ['required', 'array', 'min:1'],
            'vacations.from' => ['required'],
            'vacations.to' => ['required']
        ];
    }
}
