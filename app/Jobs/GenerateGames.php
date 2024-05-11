<?php

namespace App\Jobs;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateGames //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @return void
     */
    public function handle(): void
    {
        $teamsCollection = Team::all()->pluck('id');

        // Truncate the games table
        Game::query()->truncate();

        // If the total number of teams is odd, add a dummy team to make it even
        if ($teamsCollection->count() % 2 !== 0) {
            $teamsCollection->push('dummy_team');
        }

        // Total number of teams
        $totalTeams = $teamsCollection->count();

        // Total number of rounds (weeks)
        $totalRounds = $totalTeams - 1;

        // Initialize an array to store fixtures
        $fixtures = [];
        $fixturesAway = [];

        // Generate fixtures
        for ($i = 0; $i < $totalRounds; $i++) {
            for ($j = 0; $j < $totalTeams / 2; $j++) {
                // If there's a dummy team, skip it
                if ($teamsCollection[$j] === 'dummy_team' || $teamsCollection[$totalTeams - 1 - $j] === 'dummy_team') {
                    continue;
                }

                $fixtures[] = [
                    'home_team_id' => $teamsCollection[$j],
                    'away_team_id' => $teamsCollection[$totalTeams - 1 - $j],
                    'week' => $i + 1,
                ];

                $fixturesAway[] = [
                    'home_team_id' => $teamsCollection[$totalTeams - 1 - $j],
                    'away_team_id' => $teamsCollection[$j],
                    'week' => $totalRounds + $i + 1,
                ];
            }

            $teamsCollection->splice(1, 0, $teamsCollection->pop());
        }

        Game::query()->insert(array_merge($fixtures, $fixturesAway));
    }
}
