<?php

namespace App\Http\Requests\Career;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacancyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'department_id' => 'required',
            'description' => 'required_if:condition,require',
            'responsibility' => 'required_if:condition,require',
            'description_punkt' => 'required_if:condition,require',
            'respons_punkt' => 'required_if:condition,require',
            'extra_info' => ''
        ];
    }
}
