<?php

namespace App\Http\Requests\Website\User;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

class NormalUser extends FormRequest
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
            'first_name'             => 'required|max:191',
            'last_name'              => 'required|max:191',
            'phone'                  => 'required|numeric|min:10|unique:users,phone',
            'email'                  => 'required|email|max:191|unique:users,email',
            'country_id'             => 'required|exists:countries,id',
            'city_id'                => 'nullable|exists:cities,id',
            'password'               => 'required|max:191|confirmed',
            'password_confirmation'  => 'required|min:6',
            'avatar'                 => 'nullable|image',
        ];
    }
}
