<?php

namespace App\Http\Requests\Website\Course;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

class UploadTask extends FormRequest
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
            'course_certificate_id' => 'required|exists:course_certificates,id',
            'course_id'             => 'required|exists:courses,id',
            'task'                  => 'required',

        ];
    }
}
