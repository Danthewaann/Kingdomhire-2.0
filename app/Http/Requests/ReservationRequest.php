<?php

namespace App\Http\Requests;

use App\Vehicle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\ConflictableModel;

class ReservationRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'reservations';

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
            'vehicle_id' => 'required_without:reservation',
            'reservation' => 'required_without:vehicle_id',
            'start_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'end_date' => 'required|date_format:Y-m-d|after:start_date'
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
                $data = $validator->valid();
                if (isset($data['reservation'])) {
                    $vehicle = $data['reservation']->vehicle;
                }
                else {
                    $vehicle = Vehicle::findOrFail($data['vehicle_id']);
                }

                $reservationsAndHires = $vehicle->getReservationsAndHires([
                    (isset($data['reservation']) ? $data['reservation']->id : [])
                ]);

                $new = new ConflictableModel([
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date']
                ]);

                $errorMessages = [];
                foreach ($reservationsAndHires as $item) {
                    $new->conflictsWith($item, $errorMessages);
                }

                if (!empty($errorMessages)) {
                    $validator->errors()->merge($errorMessages);
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
