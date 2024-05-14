<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayGameRequest;
use App\Models\Game;
use App\Services\ScoreGenerator;
use Illuminate\Http\Request;

class PlayGameController
{
    public function store(PlayGameRequest $request)
    {
        // to find the latest played week, create a query builder instance
        $nextWeekToPlay = Game::query()
            ->with('homeTeam', 'awayTeam')
            ->where('played', false)
            ->min('week');

        // Get the games for the latest played week
        $games = Game::query()
            ->where('played', false)
            ->when(!$request->play_all, fn($query) => $query->where('week', $nextWeekToPlay))
            ->get();

        // Loop through the games and predict the scores
        foreach ($games as $game) {
            $scoreGenerator = new ScoreGenerator($game->homeTeam, $game->awayTeam);

            // Update the game with the predicted scores
            $game->update([
                'home_team_score' => $scoreGenerator->getHomeTeamScore(),
                'away_team_score' => $scoreGenerator->getAwayTeamScore(),
                'played' => true,
            ]);
        }

        return redirect()->route('simulation.create');
    }

    public function destroy()
    {
        Game::query()->update([
            'home_team_score' => 0,
            'away_team_score' => 0,
            'played' => false,
        ]);

        return redirect()->route('simulation.create');
    }
}
