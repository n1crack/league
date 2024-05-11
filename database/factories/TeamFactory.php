<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement($this->teamNames()),
            'team_power' => $this->faker->numberBetween(10, 120),
        ];
    }

    public function teamNames(): array
    {
        return [
            'Arsenal',
            'Chelsea',
            'Liverpool',
            'Manchester United',
            'Manchester City',
            'Tottenham Hotspur',
            'Leicester City',
            'West Ham United',
            'Everton',
            'Aston Villa',
            'Leeds United',
            'Wolverhampton Wanderers',
            'Crystal Palace',
            'Southampton',
            'Newcastle United',
            'Brighton & Hove Albion',
            'Burnley',
            'Fulham',
            'West Bromwich Albion',
            'Sheffield United'
        ];
    }
}
