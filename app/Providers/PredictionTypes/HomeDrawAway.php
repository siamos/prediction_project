<?php

namespace App\Providers\PredictionTypes;

use App\Http\Interfaces\PredictionValidationInterface;
use Illuminate\Support\Str;
use App\Constants\CustomValidation;

class HomeDrawAway implements PredictionValidationInterface
{
    public function getPredictionValidation(string $prediction): bool
    {
        $customValidation = new CustomValidation();

        return in_array(Str::upper($prediction), $customValidation->getPredictionTypes());
    }
}