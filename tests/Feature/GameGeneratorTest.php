<?php

use App\Services\GameGenerator;
use App\Models\Team;

it('generates fixtures for even number of teams', function() {
    $teams = Team::factory()->count(4)->create();

    $gameGenerator = new GameGenerator($teams->pluck('id'));
    $fixtures = $gameGenerator->generate();

    // The number of fixtures should be the number of teams multiplied by the number of teams minus one
    expect(count($fixtures))->toBe($teams->count() * ($teams->count() - 1));
});

it('generates fixtures for odd number of teams', function() {
    $teams = Team::factory()->count(5)->create();

    $gameGenerator = new GameGenerator($teams->pluck('id'));
    $fixtures = $gameGenerator->generate();

    expect(count($fixtures))->toBe($teams->count() * ($teams->count() - 1));
});

it('generates fixtures without dummy team when the number of teams is odd', function() {
    $teams = Team::factory()->count(3)->create();

    $gameGenerator = new GameGenerator($teams->pluck('id'));
    $fixtures = $gameGenerator->generate();

    expect($fixtures)->not()->toContain('dummy_team');
});

it('generates fixtures with home and away teams', function() {
    $teams = Team::factory()->count(4)->create();

    $gameGenerator = new GameGenerator($teams->pluck('id'));
    $fixtures = $gameGenerator->generate();

    foreach ($fixtures as $fixture) {
        expect($fixture['home_team_id'])->not->toBe($fixture['away_team_id']);
    }
});


