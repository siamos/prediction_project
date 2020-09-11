<?php

namespace App\Constants;

class CustomValidation {

  private const CORRECT_SCORE  = 'correct_score';
  private const HOME_DRAW_AWAY = '1x2';
  private const HOME           = '1';
  private const DRAW           = 'X';
  private const AWAY           = '2';
  private const WIN            = 'win';
  private const LOST           = 'lost';

  private $market_types     = [self::CORRECT_SCORE, self::HOME_DRAW_AWAY];
  private $prediction_types = [self::HOME, self::DRAW, self::AWAY];
  private $status_types     = [self::WIN, self::LOST];

  public function getMarketTypes(): array
  {
      return $this->market_types;
  }

  public function getPredictionTypes(): array
  {
      return $this->prediction_types;
  }

  public function getStatusTypes(): array
  {
      return $this->status_types;
  }

  public function getCorrectScore(): string
  {
      return self::CORRECT_SCORE;
  }

  public function getHomeDrawAway(): string
  {
      return self::HOME_DRAW_AWAY;
  }

}