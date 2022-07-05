<?php

namespace App\Http\Requests\Website\Course;

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
            'title'                    => 'required|max:191',
            'description'              => 'nullable',
            'requirements'             => 'nullable',
            'image'                    => 'nullable',
            'promotional_video'        => 'nullable',
            'type'                     => 'nullable',
            'price'                    => 'nullable|numeric',
            'discount'                 => 'nullable|numeric',
            'language'                 => 'nullable|in:ar,en',
            'level'                    => 'nullable|exists:academic_levels,id',
            'total_hours'              => 'nullable',
            'categories'               => 'required',
            'course_id'                => 'nullable|exists:courses,id',
            'category_id'              => 'required|exists:categories,id',

        ];
    }
}
