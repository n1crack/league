<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Repositories\FixtureRepository;
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

        return Inertia::render('Simulation/Index', [
            'teams' => $teams,
            'games' => $games->groupBy('week'),
            'lastPlayedWeek' => $lastPlayedWeek
        ]);
    }

}
