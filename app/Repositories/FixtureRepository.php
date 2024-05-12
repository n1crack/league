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
            ->selectSub(self::getPts(), 'games_pts')
            ->selectSub(self::getPlayed(), 'games_played')
            ->selectSub(self::getWins(), 'games_wins')
            ->selectSub(self::getDraws(), 'games_draws')
            ->selectSub(self::getLosses(), 'games_losses')
            ->selectSub(self::getGoalDifferences(), 'goal_difference')
            ->orderBy('games_pts', 'desc')
            ->orderBy('goal_difference', 'desc')
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
    private static function getDraws(): Builder
    {
         return Game::query()
            ->selectRaw('count(*)')
            ->whereAny(['home_team_id', 'away_team_id'], DB::raw('teams.id'))
            ->where('is_draws', true)
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

    private static function getPts(): Builder
    {
        return Game::query()
            ->selectRaw(
                'SUM(CASE
                WHEN played = true AND home_team_id = teams.id AND winner_id = teams.id THEN 3
                WHEN played = true AND away_team_id = teams.id AND winner_id = teams.id THEN 3
                WHEN played = true AND home_team_id = teams.id AND is_draws = true THEN 1
                WHEN played = true AND away_team_id = teams.id AND is_draws = true THEN 1
                ELSE 0 END)'
            );
    }
}
