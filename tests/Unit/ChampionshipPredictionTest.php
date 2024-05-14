<?php

use App\Services\ChampionshipPredictor;

it('returns 100 for the first team when one match left with more than 3 points gap', function() {
    $teamPoints = collect([
        1 => 8,
        2 => 3,
    ]);

    $predictor = new ChampionshipPredictor($teamPoints, 1);
    $prediction = $predictor->predict();

    expect($prediction->first())->toBe(100.0);
});


it('returns 100 for the first team when two match left with more than 6 points gap', function() {
    $teamPoints = collect([
        1 => 8,
        2 => 1,
    ]);

    $predictor = new ChampionshipPredictor($teamPoints, 2);
    $prediction = $predictor->predict();

    expect($prediction->first())->toBe(100.0);
});

it('returns 50 for the teams if the points are equal', function() {
    $teamPoints = collect([
        1 => 8,
        2 => 8,
    ]);

    $predictor = new ChampionshipPredictor($teamPoints, 2);
    $prediction = $predictor->predict();

    expect($prediction->first())->toBe(60.0);
});


it('returns 75 for the teams if the points are equal', function() {
    $teamPoints = collect([
        1 => 6,
        2 => 4,
        3 => 1,
    ]);

    $predictor = new ChampionshipPredictor($teamPoints, 1);
    $prediction = $predictor->predict();

    expect($prediction->first())->toBe(75.0)
        ->and($prediction[2])->toBe(25.0);
});
