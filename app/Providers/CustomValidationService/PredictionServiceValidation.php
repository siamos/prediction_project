<?php

namespace App\Providers\CustomValidationService;

use Illuminate\Support\Str;
use App\Constants\CustomValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PredictionServiceValidation {

    private $customValidation;
    private $validator;

    public function __construct(CustomValidation $customValidation, Validator $validator) 
    {
        $this->customValidation = $customValidation;
        $this->validator        = $validator;
    }

    public function validatePrediction(string $prediction, string $marketType): bool
    {
        $contains = false;
        
        if ($this->customValidation->getCorrectScore() === $marketType) {
            $contains = Str::contains($prediction, [':']);
        } elseif ($this->customValidation->getHomeDrawAway() === $marketType) {
            $contains = in_array(Str::upper($prediction), $this->customValidation->getPredictionTypes());
        }
        
        return $contains;
    }

    public function getInputValidation(array $inputValues)
    {
        return $this->validator::make($inputValues, [
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
            'prediction'    => ['required','max:3'],
            'status'        => [
                'nullable',
                Rule::in($this->customValidation->getStatusTypes())
            ]
        ]);
    }

    public function getUpdateValidation(array $inputValues)
    {
        return $this->validator::make($inputValues, [
            'status'        => [
                Rule::in($this->customValidation->getStatusTypes())
            ]
        ]);
    }
}