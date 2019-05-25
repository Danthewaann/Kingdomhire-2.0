<?php

namespace App\Http\Requests;

use App\WeeklyRate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'name' => 'required',
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
            'weekly_rate_max.gt' => 'Max rate must be greater than min rate'
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
                if (!is_null($this->weekly_rate)) {
                    $weeklyRates = WeeklyRate::all()->reject(function ($rate) {
                        return $rate->id == $this->weekly_rate->id;
                    });
                }
                else {
                    $weeklyRates = WeeklyRate::all();
                }
                foreach ($weeklyRates as $weeklyRate) {
                    if ($weeklyRate->name == $this->name) {
                        $validator->errors()->merge([
                            'name' => 'Weekly rate \''. $this->name .'\' already exists'
                        ]);
                        $this->failedValidation($validator);
                    }
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
