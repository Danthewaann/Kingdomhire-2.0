<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Reservation;
use App\Hire;
use Illuminate\Validation\Validator;

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
            'vehicle_id' => 'required',
            'reservation_id' => 'nullable',
            'made_by' => 'required|string',
            'rate' => 'nullable|integer',
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
                $data = $validator->getData();
                $reservation_id = isset($data['reservation_id']) ? $data['reservation_id'] : null;
                $reservation = Reservation::findOrNew($reservation_id);
                $reservation->setRawAttributes([
                    'vehicle_id' => $data['vehicle_id'],
                    'made_by' => $data['made_by'],
                    'rate' => $data['rate'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date']
                ]);

                $errorMessages = [];
                $vehicle = $reservation->vehicle;
                $reservations = $vehicle->reservations->reject(function ($reservation) use ($reservation_id) {
                    return $reservation->id == $reservation_id;
                });
                $items = ($vehicle->hasActiveHire()) ? $reservations->merge(collect([$vehicle->getActiveHire()])) : $reservations;
                foreach ($items as $item) {
                    $reservation->conflictsWith($item, $errorMessages);
                }

                if (!empty($errorMessages)) {
                    $validator->errors()->merge($errorMessages);
                    $this->failedValidation($validator);
                } else {
                    //                if ($reservation->start_date == date('Y-m-d')) {
                    //                    Hire::create([
                    //                        'vehicle_id' => $data['vehicle_id'],
                    //                        'hired_by' => $data['made_by'],
                    //                        'rate' => $data['rate'],
                    //                        'start_date' => $data['start_date'],
                    //                        'end_date' => $data['end_date']
                    //                    ]);
                    //                    $reservation->delete();
                    //                } else {
                    $reservation->save();
                    //                }
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
