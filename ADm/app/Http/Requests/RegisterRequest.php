<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:50',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'min:6',
            'name' => 'required|min:5|max:40',
            'gender' => 'in:male,female,other',
            'terms_and_conditions' => 'accepted'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => $validator->errors()->first(),
        ], 400));
    }

    // public function messages()
    // {
    //     return [
    //         'email.required' => 'Email is required',
    //         'email.email' => 'Email is not correct'
    //     ];
    // }
}
