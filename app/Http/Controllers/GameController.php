<?php

namespace App\Http\Controllers;

use App\Repositories\FixtureRepository;
use App\Services\GameGenerator;
use App\Models\Game;
use Inertia\Inertia;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::query()
            ->with('homeTeam', 'awayTeam')
            ->get();
        $lastPlayedWeek = $games->where('played', true)->max('week');


        return Inertia::render('Game/Index', [
            'games' => $games->groupBy('week'),
            'lastPlayedWeek' => $lastPlayedWeek
        ]);
    }

    public function store()
    {
        // Truncate the games table
        Game::query()->truncate();

        // Generate new games
        $games = GameGenerator::generate();

        // Insert the games into the database
        Game::query()->insert($games);

        return redirect()->route('games.index');
    }
}
