<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predictions extends Model
{
    protected $table    = 'predictions_project';
    protected $fillable = ['id', 'event_id', 'market_type', 'prediction', 'status'];

}
