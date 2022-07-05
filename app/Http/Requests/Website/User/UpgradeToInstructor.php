<?php

namespace App\Http\Requests\Website\User;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

class UpgradeToInstructor extends FormRequest
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
            'phone'                  => 'required|numeric|unique:users,phone,'.auth()->id(),
            'email'                  => 'required|email|max:191|unique:users,email,'.auth()->id(),
            'user_type'              => 'required|in:3',
            'language'               => 'required',
            'country_id'             => 'required|exists:countries,id',
            'city_id'                => 'nullable|exists:cities,id',
            'address'                => 'nullable',
            'birth_date'             => 'required',
            'nationality'            => 'required',
            'gender'                 => 'nullable',
            'identification'         => 'nullable',
            'identification_img'     => 'required',
            'bio'                    => 'required',
            'category_id'            => 'nullable|array',
            'category_id.*'          => 'exists:categories,id',
            'user_id'                => 'nullable|exists:users,id',
            'avatar'                 => 'nullable|image',
        ];
    }
}
