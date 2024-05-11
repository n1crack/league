<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateGames;
use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('homeTeam', 'awayTeam')->get();

         return Inertia::render('Game/Index', [
            'games' => $games->groupBy('week')
        ]);

    }

    public function create()
    {
        return Inertia::render('Game/Create', [
            'teams' => Team::all()
        ]);
    }


    public function store()
    {
        GenerateGames::dispatch();

        return redirect()->route('games.index');
    }
}
