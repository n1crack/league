<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Services\ScoreGenerator;
use Illuminate\Http\Request;

class PlayGameController
{
    public function store(Request $request)
    {
        $request->validate([
            'play_all' => 'nullable|boolean',
        ]);

        // Find the latest played week
        $nextWeekToPlay = Game::query()
            ->with('homeTeam', 'awayTeam')
            ->where('played', false)
            ->min('week');

        // Get the games for the latest played week
        $games = Game::query()
            ->where('played', false)
            ->when(!$request->play_all, function($query) use ($nextWeekToPlay) {
                return $query->where('week', $nextWeekToPlay);
            })
            ->get();

        // Loop through the games and predict the scores
        foreach ($games as $game) {
            $scoreGenerator = new ScoreGenerator($game->homeTeam, $game->awayTeam);

            $homeTeamScore = $scoreGenerator->getHomeTeamScore();
            $awayTeamScore = $scoreGenerator->getAwayTeamScore();

            // Update the game with the predicted scores
            $game->update([
                'home_team_score' => $homeTeamScore,
                'away_team_score' => $awayTeamScore,
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
