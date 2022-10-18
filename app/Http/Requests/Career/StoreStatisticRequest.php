<?php

namespace App\Http\Requests\Career;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatisticRequest extends FormRequest
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
            'title_az' => 'required',
            'title_en' => 'required',
            'description_az' => 'required',
            'description_en' => 'required',
            'value' => 'required'
        ];
    }
}
