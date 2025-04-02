<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,'.$this->supplier->id,
            'contact_person_name' => 'required|string|max:255',
            'address' => 'required|string',
             'phone' => [
            'required',
            'string',
            'regex:/^03\d{9}$/',
            'unique:suppliers,phone,'.$this->supplier->id
        ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The supplier name is required.',
            'email.required' => 'The email address is required.',
            'email.unique' => 'This email is already in use.',
            'contact_person_name.required' => 'The contact person name is required.',
            'address.required' => 'The address is required.',
            'phone.required' => 'The phone number is required.',
            'phone.required' => 'The phone number is required.',
            'phone.regex' => 'Phone must be in format 03XXXXXXXXX (11 digits starting with 03)',
            'phone.unique' => 'This phone number is already in use.',
        ];
    }
}