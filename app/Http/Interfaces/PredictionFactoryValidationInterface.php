<?php

namespace App\Http\Interfaces;

interface PredictionFactoryValidationInterface
{
    public function generateValidationType(string $marketType) : PredictionValidationInterface;
}