<?php

namespace App\Http\Requests\MainWeb;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuideRequest extends FormRequest
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
            'cover' => 'required_if:condition,require|mimes:png,jpg,jpeg',
            'file_upload' => 'required_if:condition,require|mimes:png,jpg,jpeg,pdf,svg'
        ];
    }
}
