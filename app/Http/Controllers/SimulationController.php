<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Repositories\FixtureRepository;
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

        $teams = FixtureRepository::get();

        $pts = $teams->pluck('games_pts', 'id');
        $totalMatches = $teams->count() * ($teams->count() - 1) / 2;
        $weeks_played = $teams->max('games_played');
        $weeks_left = $totalMatches - $weeks_played;

        $predictions = ChampionshipPredictor::predict($pts, $weeks_left);

        return Inertia::render('Simulation/Index', [
            'teams' => $teams,
            'games' => $games->groupBy('week'),
            'lastPlayedWeek' => $lastPlayedWeek,
            'predictions' => $predictions
        ]);
    }

}
