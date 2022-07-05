<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
            'first_name'=> 'required|max:191',
            'last_name' => 'required|max:191',
            'phone'     => 'required|numeric|unique:users,phone',
            'email'     => 'required|email|max:191|unique:users,email',
            'password'  => 'nullable|max:191',
            'avatar'    => 'nullable|image',
            'role_id'   => 'nullable|exists:roles,id',
        ];
    }
}
