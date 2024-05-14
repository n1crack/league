<?php

namespace App\Http\Controllers;

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

        $teamsCollection = Team::all()->pluck('id');
        $gameGenerator = new GameGenerator($teamsCollection);
        // Generate new games
        $games = $gameGenerator->generate();

        // Insert the games into the database
        Game::query()->insert($games);

        return redirect()->route('games.index');
    }

    public function update(Game $game, Request $request)
    {
        if (!$game->played) {
            return redirect()->route('games.index');
        }

        $request->validate([
            'side' => 'required|in:home,away',
            'score' => 'required|integer|min:0|max:20'
        ]);

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
