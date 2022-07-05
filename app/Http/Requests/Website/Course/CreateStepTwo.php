<?php

namespace App\Http\Requests\Website\Course;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

class CreateStepTwo extends FormRequest
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
            'course_lectures'          => 'required',
            'course_id'                => 'required|exists:courses,id',

        ];
    }
}
