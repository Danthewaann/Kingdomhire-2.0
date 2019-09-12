<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\ConflictableModel;

class HireUpdateRequest extends FormRequest
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
            'hire' => 'required',
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date'
        ];
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
