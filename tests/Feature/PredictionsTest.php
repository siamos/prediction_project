<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;
use App\Models\Predictions;


class PredictionsTest extends TestCase
{
    use RefreshDatabase;

    public function testPredictionsCreation()
    {
        $payload = [
            'event_id' => 3432423,
            'market_type' => 'correct_score',
            'prediction' => '2:2',
        ];

        $this->json('POST', '/v1/predictions', $payload)
            ->assertStatus(204);
    }

    public function testPredictionsUpdate()
    {        
        $prediction = factory(Predictions::class)->create([
            'id' => 1,
            'event_id' => 44432,
            'market_type' => 'correct_score',
            'prediction' => '1:2',
            'status'     => 'unresolved'
        ]);

        $payload = [
            'status' => 'lost'
        ];

        $response = $this->json('PUT', '/v1/predictions/1/status' , $payload)
            ->assertStatus(204);
    }

    public function testPredictionsList()
    {
        factory(Predictions::class)->create([
            'id' => 1,
            'event_id' => 44432,
            'market_type' => 'correct_score',
            'prediction' => '1:2',
            'status'     => 'unresolved'
        ]);

        factory(Predictions::class)->create([
            'id' => 2,
            'event_id' => 322,
            'market_type' => '1x2',
            'prediction' => '1',
            'status'     => 'unresolved'
        ]);

        $response = $this->json('GET', '/v1/predictions/', [])
            ->assertStatus(200)
            ->assertJson([
                [ 'id' => 1,
                'event_id' => 44432,
                'market_type' => 'correct_score',
                'prediction' => '1:2',
                'status'     => 'unresolved'
                ],
                [ 
                     'id' => 2,
                'event_id' => 322,
                'market_type' => '1x2',
                'prediction' => '1',
                'status'     => 'unresolved'
                ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'event_id', 'market_type', 'prediction', 'status', 'created_at', 'updated_at'],
            ]);
    }
}
