<?php

use App\Builders\FixtureBuilder;
use Illuminate\Database\Eloquent\Builder;

it('should construct FixtureBuilder', function() {
    $fixtureBuilder = new FixtureBuilder();

    expect($fixtureBuilder)->toBeInstanceOf(FixtureBuilder::class);
});

it('should build fixture', function() {
    $fixtureBuilder = new FixtureBuilder();
    $fixture = $fixtureBuilder->build();

    expect($fixture)->toBeInstanceOf(\Illuminate\Support\Collection::class);
});

it('should return builder instance from the builder methods', function() {
    $fixtureBuilder = new FixtureBuilder();
    $playedQuery = $fixtureBuilder->getPlayed();
    $pointsQuery = $fixtureBuilder->getPoints();
    $winsQuery = $fixtureBuilder->getWins();
    $drawsQuery = $fixtureBuilder->getDraws();
    $lossesQuery = $fixtureBuilder->getLosses();
    $goalDifferencesQuery = $fixtureBuilder->getGoalDifferences();

    expect($playedQuery)->toBeInstanceOf(Builder::class)
        ->and($pointsQuery)->toBeInstanceOf(Builder::class)
        ->and($winsQuery)->toBeInstanceOf(Builder::class)
        ->and($drawsQuery)->toBeInstanceOf(Builder::class)
        ->and($lossesQuery)->toBeInstanceOf(Builder::class)
        ->and($goalDifferencesQuery)->toBeInstanceOf(Builder::class);
});




