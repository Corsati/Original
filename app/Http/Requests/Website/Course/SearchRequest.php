<?php

namespace App\Http\Requests\Website\Course;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

class SearchRequest extends FormRequest
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
            'name_search'           => 'nullable|string',
            'search'                => 'nullable|string',
            'topics'                => 'nullable|array',
            'topics.*'              => 'exists:categories,id',
            'levels'                => 'nullable|array',
            'levels.*'              => 'exists:academic_levels,id',
            'prices'                => 'nullable|array',
            'prices.*'              => 'in:paid,free',
            'durations'             => 'nullable|array',
            'durations.*'           => 'exists:durations,id',
            'ratings'               => 'nullable|array',
            'ratings.*'             => 'nullable|in:1,2,3,4,5',
            'orderBy'               => 'nullable|in:ASC,DESC',
        ];
    }
}
