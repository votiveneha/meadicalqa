<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkEnvironmentRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->input('form_type')) {
            case 'environment_form':
                return [
                    'env_name' => 'required'
                ];

            case 'position_form':
                return [
                    'position_name' => 'required'
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'env_name.required' => 'The environment name field is required.',
            'position_name.required' => 'The position name field is required.',
        ];
    }
}
