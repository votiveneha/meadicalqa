<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfile extends FormRequest
{
    public function rules()
    {
        return [
            'fullname' => 'required', 'min:3',
            'lastname' => 'required',
            'countryCode' => 'required',
           
            'contact' => 'required',
            'bio' => 'required',
            'post_code' => 'required',
            
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'The First name field is required.',
            'lastname.required' => 'The Last name field is required.',
            'countryCode.required' => 'The Country Code field is required.',
            
            'contact.required' => 'The Mobile Number  field is required.',
            'bio.required' => 'The Bio field is required.',
            'post_code.required' => 'The Post_code field is required.',
            
            'country.required' => 'Please Select Country.',
            'state.required' => 'Please Select State.',
            'city.required' => 'The City field is required.',
            
           
            // 'email.required' => 'The email field is required.',
        ];
    }
}
