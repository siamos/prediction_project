<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionsProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predictions_project', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('event_id')->unsigned()->default(0)->unique();
            $table->enum('market_type', ['1x2', 'correct_score'])->nullable();
            $table->string('prediction')->nullable();
            $table->enum('status', ['win', 'lost', 'unresolved'])->default('unresolved');
            $table->timestamps();
            $table->index('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predictions_project');
    }
}
