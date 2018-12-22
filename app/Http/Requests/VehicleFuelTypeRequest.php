<?php

namespace App\Http\Requests;

use App\VehicleFuelType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class VehicleFuelTypeRequest extends FormRequest
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
            'vehicle_fuel_type' => 'nullable'
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
                if (!is_null($this->vehicle_fuel_type)) {
                    $vehicleFuelTypes = VehicleFuelType::all()->reject(function ($fuelType) {
                        return $fuelType->id == $this->vehicle_fuel_type->id;
                    });
                }
                else {
                    $vehicleFuelTypes = VehicleFuelType::all();
                }
                foreach ($vehicleFuelTypes as $vehicleFuelType) {
                    if ($vehicleFuelType->name == $this->name) {
                        $validator->errors()->merge([
                            'name' => 'Fuel type \''. $this->name .'\' already exists'
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
