<?php

namespace App\Http\Requests\Website\User;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'first_name'             => 'nullable',
            'last_name'              => 'nullable',
            'country_id'             => 'nullable|exists:countries,id',
            'city_id'                => 'nullable|exists:cities,id',
            'category_id'            => 'nullable|exists:categories,id',
            'about'                  => 'nullable|max:191',
            'avatar'                 => 'nullable|image',
            'password'               => 'nullable|max:191|confirmed',
            'bio'                    => 'nullable',
            'email'                  => 'nullable|unique:users,email,' . auth()->id(),
            'phone'                  => 'nullable|unique:users,phone,' . auth()->id(),

        ];
    }
}
