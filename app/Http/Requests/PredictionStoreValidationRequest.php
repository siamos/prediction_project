<?php

namespace App\Http\Requests;

use App\Constants\CustomValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PredictionStoreValidationRequest extends FormRequest
{
    private $customValidation;
 

    public function __construct()
    {
        $this->customValidation = new CustomValidation();
    }


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'event_id'      => ['required', 
                'numeric',
                'min:0', 
                'not_in:0', 
                'unique:predictions_project,event_id'
            ],
            'market_type'   => [
                'required',
                Rule::in($this->customValidation->getMarketTypes())
            ],
            'prediction'    => ['required'],
            'status'        => [
                'nullable',
                Rule::in($this->customValidation->getStatusTypes())
            ]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(null, 400));
    }
}
