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
        $diffStrength = $this->homeTeam->strength - $this->awayTeam->strength;

        // calculate the score
        return new Fluent([
            'home_team_score' => $this->simulateGoals($this->homeTeam->strength, $diffStrength),
            'away_team_score' => $this->simulateGoals($this->awayTeam->strength, -$diffStrength),
        ]);
    }

    private function simulateGoals($strength, $diffStrength): float|int
    {
        // if the difference in strength is greater, than the stronger team will score more goals
        $lambda = ($strength + $diffStrength) / 4; // ortalam gol sayısı (max 2.5 min 0.25)
        $goals = [];
        $probabilities = [];

        // create a cumulative probability distribution
        for ($i = 0; $i < 5; $i++) {
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
