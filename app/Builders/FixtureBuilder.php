<?php

namespace App\Builders;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FixtureBuilder
{
    private Builder $query;

    /**
     * FixtureBuilder constructor.
     */
    public function __construct()
    {
        $this->query = Team::query();
    }

    /**
     * Build the fixture
     * @return Collection|array
     */
    public function build(): Collection|array
    {
        return $this->query
            ->select('teams.*')
            ->selectSub($this->getPts(), 'games_pts')
            ->selectSub($this->getPlayed(), 'games_played')
            ->selectSub($this->getWins(), 'games_wins')
            ->selectSub($this->getDraws(), 'games_draws')
            ->selectSub($this->getLosses(), 'games_losses')
            ->selectSub($this->getGoalDifferences(), 'goal_difference')
            ->orderBy('games_pts', 'desc')
            ->orderBy('goal_difference', 'desc')
            ->get();
    }

    /**
     *  Get the played games count for the teams
     * @return Builder
     */
    private function getPlayed(): Builder
    {
        return Game::query()
            ->selectRaw('count(*)')
            ->whereAny(['home_team_id', 'away_team_id'], DB::raw('teams.id'))
            ->where('played', true);
    }

    /**
     *  Get the wins count for the teams
     * @return Builder
     */
    private function getWins(): Builder
    {
        return Game::query()
            ->selectRaw('count(*)')
            ->whereColumn('winner_id', 'teams.id')
            ->where('played', true);
    }

    /**
     *  Get the draws count for the teams
     * @return Builder
     */
    private function getDraws(): Builder
    {
        return Game::query()
            ->selectRaw('count(*)')
            ->whereAny(['home_team_id', 'away_team_id'], DB::raw('teams.id'))
            ->where('is_draws', true)
            ->where('played', true);
    }

    /**
     *  Get the losses count for the teams
     * @return Builder
     */
    private function getLosses(): Builder
    {
        return Game::query()
            ->selectRaw('count(*)')
            ->whereColumn('loser_id', 'teams.id')
            ->where('played', true);
    }

    /**
     *  Get the goal differences for the teams
     * @return Builder
     */
    private function getGoalDifferences(): Builder
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

    /**
     * Get the total points for the teams
     * @return Builder
     */
    private function getPts(): Builder
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
