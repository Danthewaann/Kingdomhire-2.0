<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Reservation;
use App\Hire;
use Illuminate\Validation\Validator;

class HireRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'hires';

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
            'vehicle_id' => 'required',
            'hire_id' => 'required',
            'hired_by' => 'nullable|string',
            'rate' => 'nullable|integer',
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date'
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
                $data = collect($validator->getData());
                $hire = Hire::find($data['hire_id']);
                $original_data = collect($hire->getOriginal());
                $data = $original_data->merge($data)->only([
                    'vehicle_id',
                    'hired_by',
                    'rate',
                    'start_date',
                    'end_date',
                    'is_active'
                ]);
                foreach (array_keys($data->toArray()) as $key) {
                    if ($data[$key] != null) {
                        $hire->setAttribute($key, $data[$key]);
                    }
                }

                $errorMessages = [];
                foreach ($hire->vehicle->reservations as $reservation) {
                    $hire->conflictsWith($reservation, $errorMessages);
                }

                if (!empty($errorMessages)) {
                    $validator->errors()->merge($errorMessages);
                    $this->failedValidation($validator);
                } else {
                    $hire->save();
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
