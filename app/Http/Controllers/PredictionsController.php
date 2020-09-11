<?php

namespace App\Http\Controllers;

use App\Models\Predictions;
use App\Constants\CustomValidation;
use Illuminate\Http\Request;
use App\Providers\CustomValidationService\PredictionServiceValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PredictionsController extends Controller
{

    public function index()
    {
        return Predictions::all();
    }

    public function show(Predictions $prediction)
    {
        return $prediction;
    }

    public function store(Request $request, Predictions $prediction)
    {
        $predictionServiceCustomValidation = $this->getPredictionService();
        $inputValues                       = $request->all();

        $validator = $predictionServiceCustomValidation
                ->getInputValidation($inputValues);
        
        $predictionCustomValidation = $predictionServiceCustomValidation
                ->validatePrediction(
                    $inputValues['prediction'],
                    $inputValues['market_type']
                );

        if ($validator->fails() || !$predictionCustomValidation) {
            Log::error('Failed to created new prediction');
            return response()->json(null, 400);
        }

        $result = $prediction->firstOrCreate($inputValues);   

        Log::info('Successfully created new prediction with id:' .$result->id);
        return response()->json($result, 204);
    }

    public function update(Request $request, Predictions $prediction)
    {
        $predictionServiceCustomValidation = $this->getPredictionService();
        $updatedValues                     = $request->all();

        $validator = $predictionServiceCustomValidation
                ->getUpdateValidation($updatedValues);

        if ($validator->fails()) {
            Log::error('Failed to update prediction with id:'.$prediction->id);
            return response()->json(null, 400);
        }
        $result = $prediction->update($updatedValues);
        Log::info('Successfully updated prediction with id:'.$prediction->id);
        return response()->json($result, 204);
    }

    public function delete(Predictions $prediction)
    {
        $prediction->delete();
        Log::alert('Successfully deleted prediction with id:' .$prediction->id);
        return response()->json(null, 204);
    }

    private function getPredictionService(): PredictionServiceValidation
    {
        return new PredictionServiceValidation(
            new CustomValidation(),
            new Validator()
        );
    }

}
