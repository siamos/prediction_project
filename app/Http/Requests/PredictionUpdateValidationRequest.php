<?php

namespace App\Http\Requests;

use App\Constants\CustomValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PredictionUpdateValidationRequest extends FormRequest
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
            'status' => [
                Rule::in($this->customValidation->getStatusTypes())
            ]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(null, 400));
    }
}
