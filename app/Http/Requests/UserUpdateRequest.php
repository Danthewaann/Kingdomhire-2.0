<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email' . ((is_null(Auth::user())) ? ("") : ("," . Auth::user()->id)),
            'receives_email' => 'nullable|boolean',
            'password' => 'required',
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
            'email.unique' => 'Provided email is already in use'
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
            if (!Hash::check($this->password, Auth::user()->password)) {
                $validator->errors()->add('password', 'Provided password is incorrect');
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
