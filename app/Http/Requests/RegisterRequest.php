<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return
            [
        'name'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required|min:8'
            ];
    }
    public function messages()
    {
        return [
            'name.required'    =>    __('auth.name_required'    ),
            'email.required'   =>   __('auth.email_required'   ),
            'email.unique'     =>     __('auth.email_unique'   ),
            'password.required' =>   __('auth.password_required'),
            'password.min'=>     __('auth.password_min'     )
               ];
    }
}
