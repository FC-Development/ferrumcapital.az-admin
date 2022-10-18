<?php

namespace App\Http\Requests\Career;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;

class StoreApplication extends FormRequest
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
    public function rules(Request $request)
    {
        $decoded = json_decode(request()->input('form_values'),true);
        $rules= [ 
            'name' => ['required'],
            'surname'=> ['required'],
            'birthdate'=>['required','date'],
            'phone'=>['required'],
            'city'=> ['required','alpha'],
            'adress' => ['required'],
        ];
        $validator = Validator::make($decoded,$rules);
        if($validator->passes()){
            return [
                'cv' => ['required','mimes:doc,docx,pdf'],
                
            ];
        } else {
             throw ValidationException::withMessages($validator->errors()->all());
        }
        
    }
}