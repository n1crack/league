<?php

namespace App\Services;

use App\Models\Team;
use Illuminate\Support\Fluent;

class ScoreGenerator
{
    private Fluent $results;

    public function __construct(
        public Team $homeTeam,
        public Team $awayTeam
    ) {
        $this->results = $this->generate();
    }

    public function getHomeTeamScore(): int
    {
        return $this->results->home_team_score;
    }

    public function getAwayTeamScore(): int
    {
        return $this->results->away_team_score;
    }

    private function generate(): Fluent
    {
        $diffPower = ($this->homeTeam->team_power - $this->awayTeam->team_power) / 2;
        $homeFactor = 1.2;
        $awayFactor = 0.8;

        // calculate the score
        return new Fluent([
            'home_team_score' => $this->simulateGoals($this->homeTeam->team_power * $homeFactor, $diffPower),
            'away_team_score' => $this->simulateGoals($this->awayTeam->team_power * $awayFactor, -$diffPower),
        ]);
    }

    private function simulateGoals($team_power, $diffPower): float|int
    {
        // avarage number of goals scored by the team is the team_power divided by 4
        // if the difference in team_power is greater, than the stronger team will score more goals
        $lambda = ($team_power + $diffPower) / 4;
        $goals = [];
        $probabilities = [];

        // create a cumulative probability distribution
        for ($i = 0; $i < 10; $i++) {
            $goals[] = self::poisson($lambda, $i);
            $probabilities[$i] = ($probabilities[$i - 1] ?? 0) + $goals[$i] ?? 0;
        }
        $collection = collect($probabilities);

        // Generate a random number between 0 and 1
        $randomNumber = mt_rand() / mt_getrandmax();

        // Find the goal count based on the random number
        // find the first probability that is greater than the random number
        $goalCount = $collection->search(function($probability) use ($randomNumber) {
            return $randomNumber <= round($probability, 2);
        });

        return $goalCount ?: 0;
    }

    // poissson distribution found at:
    // https://acikders.ankara.edu.tr/pluginfile.php/102511/mod_resource/content/0/Konu%206.pdf
    private static function poisson($lambda, $k): float|int
    {
        return (exp(-$lambda) * pow($lambda, $k)) / self::factorial($k);
    }

    private static function factorial($k): float|int
    {
        if ($k == 0) {
            return 1;
        }

        return $k * self::factorial($k - 1);
    }
}
