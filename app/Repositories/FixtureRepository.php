<?php

namespace App\Repositories;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FixtureRepository
{
    public static function get(): Collection|array
    {
        return Team::query()
            ->select('teams.*')
            ->selectSub(self::getPlayed(), 'games_played')
            ->selectSub(self::getWins(), 'games_wins')
            ->selectSub(self::getDrawn(), 'games_drawn')
            ->selectSub(self::getLosses(), 'games_losses')
            ->selectSub(self::getGoalDifferences(), 'goal_difference')
            ->orderBy('games_wins', 'desc')
            ->orderBy('games_drawn', 'desc')
            ->get();
    }

    /**
     * @return Builder
     */
    private static function getPlayed(): Builder
    {
        return Game::query()
            ->selectRaw('count(*)')
            ->whereAny(['home_team_id', 'away_team_id'], DB::raw('teams.id'))
            ->where('played', true);
    }

    /**
     * @return Builder
     */
    private static function getWins(): Builder
    {
        return Game::query()
            ->selectRaw('count(*)')
            ->whereColumn('winner_id', 'teams.id')
            ->where('played', true);
    }

    /**
     * @return Builder
     */
    private static function getDrawn(): Builder
    {
         return Game::query()
            ->selectRaw('count(*)')
            ->whereAny(['home_team_id', 'away_team_id'], DB::raw('teams.id'))
            ->where('is_drawn', true)
            ->where('played', true);
    }


    /**
     * @return Builder
     */
    private static function getLosses(): Builder
    {
        return Game::query()
            ->selectRaw('count(*)')
            ->whereColumn('loser_id', 'teams.id')
            ->where('played', true);
    }

    private static function getGoalDifferences(): Builder
    {
        return Game::query()
            ->selectRaw(
                'SUM(CASE
                WHEN home_team_id = teams.id THEN home_team_score - away_team_score
                WHEN away_team_score = teams.id THEN away_team_score - home_team_score
                ELSE 0 END)'
            )
            ->where('played', true);
    }
}
