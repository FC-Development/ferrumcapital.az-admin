<?php

namespace App\Http\Requests\MainWeb;

use Illuminate\Foundation\Http\FormRequest;

class StorePfStatsRequest extends FormRequest
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
            //
            'header_az' => 'required',
            'header_en' => 'required',
            'value' => 'required',
            'category_az' => 'required',
            'category_en' => 'required'
        ];
    }
}
