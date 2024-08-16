<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionRequests extends FormRequest
{
    public function rules()
    {
        return [
            'nurseType[]' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'nurseType[].required' => 'The Nurse Type field is required.'
            
           
            // 'email.required' => 'The email field is required.',
        ];
    }
}
