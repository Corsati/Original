<?php

namespace App\Http\Requests\Website\User;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

class Create extends FormRequest
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
            'password'               => 'required|max:191|confirmed',
            'password_confirmation'  => 'required|min:6|same:password',
            'phone'                  => 'required|numeric|min:10|unique:users,phone',
            'email'                  => 'required|email|max:191|unique:users,email',
            'bio'                    => 'required|string',
            'category_id'            => 'required|array',
            'category_id.*'          => 'exists:categories,id',
            'identification_img'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'city_id'                => 'nullable|exists:cities,id',
            'country_id'             => 'required|exists:countries,id',
            'language'               => 'required|in:ar,en',
            'nationality'            => 'required|exists:nationalities,id',
            'gender'                 => 'nullable|in:male,female',
            'birth_date'             => 'required|string',
            'last_name'              => 'required|max:191|string',
            'first_name'             => 'required|max:191|string',


            'role_id'                => 'nullable|exists:roles,id',
            'user_type'              => 'required|in:3',
            'address'                => 'nullable|max:191|string',
            'identification'         => 'nullable|max:191|string',
            'bank_name'              => 'nullable|max:191|string',
            'iban_number'            => 'nullable|max:191|string',
            'user_id'                => 'nullable|exists:users,id',
            'avatar'                 => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
