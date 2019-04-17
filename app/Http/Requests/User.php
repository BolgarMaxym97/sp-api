<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @param $id
     * @return array
     */
    public function rules()
    {
        return [
            'name_first' => ['required'],
            'name_last' => ['required'],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
            'is_customer' => ['sometimes', 'boolean'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->id],
            'password' => ['sometimes', 'min:6', 'confirmed']
        ];
    }
}
