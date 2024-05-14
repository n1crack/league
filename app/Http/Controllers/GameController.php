<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateScoreRequest;
use App\Models\Game;
use App\Models\Team;
use App\Services\GameGenerator;
use Illuminate\Http\Request;
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
        $gameGenerator = new GameGenerator(Team::query()->pluck('id'));

        // Insert the games into the database
        Game::query()->insert($gameGenerator->generate());

        return redirect()->route('games.index');
    }

    public function update(Game $game, UpdateScoreRequest $request)
    {
        if ($request->side == 'home') {
            $game->update([
                'home_team_score' => $request->score
            ]);
        }

        if ($request->side == 'away') {
            $game->update([
                'away_team_score' => $request->score
            ]);
        }
    }

}
