<?php

use App\Models\Team;
use App\Services\ScoreGenerator;

it('generates scores for home and away teams', function () {
    $homeTeam = Team::factory()->create(['team_power' => 10]);
    $awayTeam = Team::factory()->create(['team_power' => 3]);
    $scoreGenerator = new ScoreGenerator($homeTeam, $awayTeam);

    $homeScore = $scoreGenerator->getHomeTeamScore();
    $awayScore = $scoreGenerator->getAwayTeamScore();

    expect($homeScore)->toBeInt()->toBeGreaterThanOrEqual(0)
        ->and($awayScore)->toBeInt()->toBeGreaterThanOrEqual(0);
});

