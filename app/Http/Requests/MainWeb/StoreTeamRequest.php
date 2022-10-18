<?php

namespace App\Http\Requests\MainWeb;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'linkedin' => 'url',
            'another_link' => 'url',
            'cover_photo' => 'required_if:condition,require|mimes:png,jpg,jpeg',
            'another_image' => 'mimes:png,jpg,jpeg',
            'about_text_az' => 'min:3',
            'about_text_en' => 'min:3'
        ];
    }
}
