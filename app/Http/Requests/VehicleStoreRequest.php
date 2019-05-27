<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleStoreRequest extends FormRequest
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
            'seats' => 'required|numeric|min:1|max:256',
            'weeklyRate' => 'required',
            'vehicleType' => 'required',
            'fuelType' => 'required',
            'gearType' => 'required',
            'vehicle_images' => 'nullable',
            'vehicle_images.*' => 'image|mimes:jpeg,jpg,png,gif'
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
            'vehicle_images.*.image' => 'Only image type files can be uploaded',
            'vehicle_images.*.mimes' => 'Images must be a file of type: jpeg, jpg, png, gif.'
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
            //TODO need to validate provided images
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
