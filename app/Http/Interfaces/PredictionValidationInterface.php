<?php

namespace App\Http\Interfaces;

interface PredictionValidationInterface
{
    public function getPredictionValidation(string $prediction): bool;
}