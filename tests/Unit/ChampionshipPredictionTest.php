<?php

use App\Services\ChampionshipPredictor;

it('returns 100 for the first team when one match left with more than 3 points gap', function() {
    $teamPoints = collect([
        1 => 8,
        2 => 3,
    ]);

    $prediction = ChampionshipPredictor::predict($teamPoints, weeks_left: 1);

    expect($prediction->first())->toBe(100.0);
});


it('returns 100 for the first team when two match left with more than 6 points gap', function() {
    $teamPoints = collect([
        1 => 8,
        2 => 1,
    ]);

    $prediction = ChampionshipPredictor::predict($teamPoints, weeks_left: 2);

    expect($prediction->first())->toBe(100.0);
});

it('returns 50 for the teams if the points are equal', function() {
    $teamPoints = collect([
        1 => 8,
        2 => 8,
    ]);

    $prediction = ChampionshipPredictor::predict($teamPoints, weeks_left: 2);

    expect($prediction->first())->toBe(50.0);
});


it('returns 75 for the teams if the points are equal', function() {
    $teamPoints = collect([
        1 => 6,
        2 => 4,
        3 => 1,
    ]);

    $prediction = ChampionshipPredictor::predict($teamPoints, weeks_left: 1);

    expect($prediction->first())->toBe(75.0)
        ->and($prediction[2])->toBe(25.0);
});
