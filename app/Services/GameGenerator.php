<?php

namespace App\Services;

use Illuminate\Support\Collection;

class GameGenerator
{
    public function __construct(protected Collection $teamsCollection)
    {
    }

    public function generate(): array
    {
        // If the total number of teams is odd, add a dummy team to make it even
        if ($this->teamsCollection->count() % 2 !== 0) {
            $this->teamsCollection->push('dummy_team');
        }

        // Total number of teams
        $totalTeams = $this->teamsCollection->count();

        // Total number of rounds (weeks)
        $totalRounds = $totalTeams - 1;

        // Initialize an array to store fixtures
        $fixtures = [];
        $fixturesAway = [];

        // Generate fixtures
        for ($i = 0; $i < $totalRounds; $i++) {
            for ($j = 0; $j < $totalTeams / 2; $j++) {
                // If there's a dummy team, skip it
                if ($this->teamsCollection[$j] === 'dummy_team' || $this->teamsCollection[$totalTeams - 1 - $j] === 'dummy_team') {
                    continue;
                }

                $fixtures[] = [
                    'home_team_id' => $this->teamsCollection[$j],
                    'away_team_id' => $this->teamsCollection[$totalTeams - 1 - $j],
                    'week' => $i + 1,
                ];

                $fixturesAway[] = [
                    'home_team_id' => $this->teamsCollection[$totalTeams - 1 - $j],
                    'away_team_id' => $this->teamsCollection[$j],
                    'week' => $totalRounds + $i + 1,
                ];
            }

            $this->teamsCollection->splice(1, 0, $this->teamsCollection->pop());
        }

        return array_merge($fixtures, $fixturesAway);
    }
}
