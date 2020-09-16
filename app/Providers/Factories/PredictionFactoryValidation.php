<?php

namespace App\Providers\Factories;

use App\Http\Interfaces\PredictionFactoryValidationInterface;
use App\Http\Interfaces\PredictionValidationInterface;

use App\Constants\CustomValidation;
use App\Providers\PredictionTypes\CorrectScore;
use App\Providers\PredictionTypes\HomeDrawAway;


class PredictionFactoryValidation implements PredictionFactoryValidationInterface
{
    private $customValidation;

    public function __construct(CustomValidation $customValidation) 
    {
        $this->customValidation = $customValidation;
    }

    public function generateValidationType(string $marketType): PredictionValidationInterface
    {
        return $this->customValidation->getCorrectScore() === $marketType ? new CorrectScore() : new HomeDrawAway();
    }
}