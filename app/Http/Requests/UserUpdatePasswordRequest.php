<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'user' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
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
        if ($validator->passes()) {
            $validator->after(function (Validator $validator) {
                $data = $validator->getData();
                if (!Hash::check($data['current_password'], $data['user']->password)) {
                    $validator->errors()->merge([
                        'current_password' => 'Provided password doesn\'t match current password.'
                    ]);
                    $this->failedValidation($validator);
                }
            });
        }
    }

    /**
     * Get data to be validated from the request. From Route URL
     *
     * @return array
     */
    protected function validationData()
    {
        if (method_exists($this->route(), 'parameters')) {
            $this->request->add($this->route()->parameters());
            $this->query->add($this->route()->parameters());

            return array_merge($this->route()->parameters(), $this->all());
        }

        return $this->all();
    }
}
