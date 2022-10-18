<?php

namespace App\Http\Requests\Career;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title' => ['required','min:3'],
            'blog_body' => [],
            'cover' => ['required_if:condition,require','mimes:png,jpg,jpeg'],
            'include_image' => ['required_if:condition,require','mimes:png,jpg,jpeg'],
            'tips_text' => ['required','min:3']
        ];
    }
}
