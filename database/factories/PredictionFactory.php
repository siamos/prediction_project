<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Predictions;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Predictions::class, function (Faker $faker) {
    return [
        'event_id' => 123,
        'market_type' => 'correct_score',
        'prediction' => '2:3',
        'status' =>'unresolved',
        'created_at' => now(),
        'updated_at' => now()
    ];
});