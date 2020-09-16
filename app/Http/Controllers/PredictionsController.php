<?php

namespace App\Http\Controllers;

use App\Models\Predictions;
use App\Constants\CustomValidation;
use Illuminate\Http\Request;
use App\Providers\Factories\PredictionFactoryValidation;
use App\Http\Requests\PredictionStoreValidationRequest;
use App\Http\Requests\PredictionUpdateValidationRequest;
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

    public function store(PredictionStoreValidationRequest $request, Predictions $prediction)
    {
        $inputValues        = $request->all();
        $validatePrediction = $this->getValidationPrediction($inputValues);

        return (!$validatePrediction)
                ? $this->failedStoreResponse()
                : $this->succeedStoreResponse($prediction, $inputValues);
    }

    public function update(PredictionUpdateValidationRequest $request, Predictions $prediction)
    {
        $result = $prediction->update($request->all());
        Log::info('Successfully updated prediction', ['id' => $prediction->id]);

        return response()->json(null, 204);
    }

    public function delete(Predictions $prediction)
    {
        $prediction->delete();
        Log::alert('Successfully deleted prediction', ['id' => $prediction->id]);
        return response()->json(null, 204);
    }

    private function getValidationPrediction(array $inputValues): bool
    {
        $validationFactory  = new PredictionFactoryValidation(new CustomValidation());
        $validatonType      = $validationFactory->generateValidationType($inputValues['market_type']);

        return $validatonType->getPredictionValidation($inputValues['prediction']);
    }

    private function failedStoreResponse()
    {
        Log::error('Failed to created new prediction');
        return response()->json(null, 400);
    }

    private function succeedStoreResponse(Predictions $prediction, array $inputValues)
    {
        $result = $prediction->firstOrCreate($inputValues);   
        Log::info('Successfully created new prediction', ['id' => $result->id]);

        return response()->json(null, 204);
    }

}
