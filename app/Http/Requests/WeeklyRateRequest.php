<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeeklyRateRequest extends FormRequest
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
            'name' =>'required|unique:weekly_rates,name' . ((is_null($this->weekly_rate)) ? ("") : ("," . $this->weekly_rate['id'])),
            'weekly_rate' => 'nullable',
            'weekly_rate_min' => 'required|numeric|min:1|',
            'weekly_rate_max' => 'required|numeric|min:2|gt:weekly_rate_min'
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
            'name.unique' => 'Weekly rate \':input\' already exists',
            'weekly_rate_max.gt' => 'Max rate must be greater than min rate'
        ];
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
