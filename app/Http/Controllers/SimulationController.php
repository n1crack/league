<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Builders\FixtureBuilder;
use App\Services\ChampionshipPredictor;
use Inertia\Inertia;

class SimulationController extends Controller
{

    public function create()
    {
        $games = Game::query()
            ->with('homeTeam', 'awayTeam')
            ->get();

        $lastPlayedWeek = $games->where('played', true)->max('week');

        $fixture = $this->buildFixture();

        $predictions = $this->predictOutcomes($fixture);

        return Inertia::render('Simulation/Index', [
            'teams' => $fixture,
            'games' => $games->groupBy('week'),
            'lastPlayedWeek' => $lastPlayedWeek,
            'predictions' => $predictions
        ]);
    }

    private function buildFixture()
    {
        return (new FixtureBuilder())->build();
    }

    private function predictOutcomes($fixture)
    {
        $points = $fixture->pluck('games_pts', 'id');
        $totalMatches = $fixture->count() * ($fixture->count() - 1) / 2;
        $weeksPlayed = $fixture->max('games_played');
        $weeksLeft = $totalMatches - $weeksPlayed;

        $predictor = new ChampionshipPredictor($points, $weeksLeft);

        return $predictor->predict();
    }
}
