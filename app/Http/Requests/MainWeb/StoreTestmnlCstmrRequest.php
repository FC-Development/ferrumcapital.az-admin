<?php

namespace App\Http\Requests\MainWeb;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestmnlCstmrRequest extends FormRequest
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
            'fullname_az' => 'required|min:3',
            'fullname_en' => 'required|min:3',
            'text_az' => 'required|min:3',
            'text_en' => 'required|min:3'
        ];
    }
}
