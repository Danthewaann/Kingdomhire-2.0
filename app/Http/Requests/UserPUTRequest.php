<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UserPUTRequest extends FormRequest
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
            'user' => 'nullable',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required_without:user|same:password'
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
            'password_confirmation.required_without' => 'Password confirmation doesn\'t match password'
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
        $validator->after(function (Validator $validator) {
            $errorMessages = [];
            $data = $validator->getData();
            if (isset($data['user'])) {
                if (!is_null($data['password'])) {
                    if (!Hash::check($data['password'], $data['user']->password)) {
                        $errorMessages['password'] = 'Provided password is incorrect';
                    }
                }
                else {
                    $this->failedValidation($validator);
                }

                $users = User::all()->reject(function ($user) use ($data){
                    return $user->id == $data['user']->id;
                });
            }
            else {
                $users = User::all();
            }

            foreach ($users as $user) {
                if ($data['email'] == $user->email) {
                    $errorMessages['email'] = 'Provided email is already in use';
                    break;
                }
            }

            if (!empty($errorMessages)) {
                $validator->errors()->merge($errorMessages);
                $this->failedValidation($validator);
            }
        });
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
