<?php

namespace App\Http\Requests\Career;

use Illuminate\Foundation\Http\FormRequest;

class StoreLifegRequest extends FormRequest
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
            'image_upload' => 'required|mimes:png,jpg,jpeg'
        ];
    }
}
