<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\WeeklyRate;
use App\VehicleFuelType;
use App\VehicleGearType;
use App\VehicleType;

class VehicleUpdateRequest extends FormRequest
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
            'make' => 'required',
            'model' => 'required',
            'seats' => 'required|numeric|min:1|max:255',
            'status' => 'nullable',
            'weeklyRate' => 'nullable',
            'type' => 'nullable',
            'fuelType' => 'nullable',
            'gearType' => 'nullable',
            'vehicle_images_add' => 'nullable',
            'vehicle_images_add.*' => 'image|mimes:jpeg,jpg,png,gif',
            'vehicle_images_del' => 'nullable|array'
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
            'make.required' => 'Vehicle make (manufacturer) is required',
            'model.required' => 'Vehicle model is required',
            'seats.required' => 'Number of seats is required',
            'vehicle_images_add.*.image' => 'Only image type files can be uploaded',
            'vehicle_images_add.*.mimes' => 'Images must be a file of type: jpeg, jpg, png, gif.'
        ];
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $weeklyRate = WeeklyRate::whereName($this->request->get('weeklyRate'))->first();
        $fuelType = VehicleFuelType::whereName($this->request->get('fuelType'))->first();
        $gearType = VehicleGearType::whereName($this->request->get('gearType'))->first();
        $type = VehicleType::whereName($this->request->get('type'))->first();

        $this->merge(['weekly_rate_id' => $weeklyRate != null ? $weeklyRate->id : null]);
        $this->merge(['vehicle_fuel_type_id' => $fuelType != null ? $fuelType->id : null]);
        $this->merge(['vehicle_gear_type_id' => $gearType != null ? $gearType->id : null]);
        $this->merge(['vehicle_type_id' => $type != null ? $type->id : null]);
        
        return parent::getValidatorInstance();
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
