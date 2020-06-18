<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class UserUpdatePasswordRequest extends FormRequest
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
        return [
            'new_password' => 'required|confirmed|min:6',
            'current_password' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'new_password.confirmed' => 'Password confirmation does not match.'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // Check that the provided password matches the user password in the database.
        $validator->after(function (Validator $validator) {
            if (!Hash::check($this->current_password, Auth::user()->password)) {
                $validator->errors()->add(
                    'current_password', 'Provided password doesn\'t match current password.'
                );
                $this->failedValidation($validator);
            }
        });
    }

    /**
     * Get data to be validated from the request. From Route URL
     *
     * @return array
     */
    public function validationData()
    {
        if (method_exists($this->route(), 'parameters')) {
            $this->request->add($this->route()->parameters());
            $this->query->add($this->route()->parameters());

            return array_merge($this->route()->parameters(), $this->all());
        }

        return $this->all();
    }
}
