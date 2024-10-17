<?php

namespace App\Http\Requests\MainWeb;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name' => 'required|min:3',
            'sector_id' => 'required',
            'phone' => 'required|min:3',
            'ig' => 'nullable|url',
            'fb' => 'nullable|url'
        ];
    }
}
