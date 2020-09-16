<?php

namespace App\Providers\PredictionTypes;

use App\Http\Interfaces\PredictionValidationInterface;

class CorrectScore implements PredictionValidationInterface
{
    public function getPredictionValidation(string $prediction): bool
    {
        preg_match('/([0-9]+)\:([0-9]+)/', $prediction, $matchArray);
         
        return !empty($matchArray);
    }
}