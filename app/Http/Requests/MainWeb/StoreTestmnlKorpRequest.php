<?php

namespace App\Http\Requests\MainWeb;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestmnlKorpRequest extends FormRequest
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
            'fullname_az' => 'required',
            'fullname_en' => 'required',
            'quote_az' => 'required',
            'quote_en' => 'required',
            'title_az' => 'required',
            'title_en' => 'required',
            'image' => 'required_if:condition,require|mimes:png,jpg,jpeg',
            'company_logo' => 'required_if:condition,require|mimes:png,jpg,jpeg,svg'
        ];
    }
}
