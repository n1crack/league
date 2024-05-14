<?php

namespace App\Services;

use Illuminate\Support\Collection;

class ChampionshipPredictor
{
    public function __construct(public  Collection $points, public int $weeks_left)
    {
    }

    public function predict(): Collection
    {
        // if the championship is over or there are more than 3 weeks left, return empty
        if ($this->weeks_left == 0 || $this->weeks_left >= 4
        ) {
            return collect();
        }

        // max point, it can be the championship point. we don't know that yet.
        $max = $this->points->max();

        // next rounds predictions for each point
        $predictions = $this->predictNextRoundsPoints($max, $this->weeks_left);

        // total result count
        $totalResult = $predictions->flatten()->count();

        // calculate the percentage of each item
        return $predictions->map(function($item) use ($totalResult) {
            return round(collect($item)->flatten()->count() / $totalResult * 100, 2);
        });
    }

    public function predictNextRoundsPoints($max, $iterate): Collection
    {
        $predictions = [];
        $isLast = true;
        foreach ($this->points as $key => $point) {
            $predictions[$key][$point] = [];

            array_push($predictions[$key][$point], ...$this->addPoints($point, $max, $iterate, $isLast));
            $isLast = false;
        }
        return collect($predictions);
    }

    public function addPoints($point, $max, $iterate, $isLast): Collection
    {
        $results = collect();
        // recursive call
        if ($iterate > 1) {
            $iterate--;
            $results->push(...$this->addPoints($point + 3, $max, $iterate, $isLast));
            $results->push(...$this->addPoints($point + 1, $max, $iterate, $isLast));
        }

        return $results
            ->when($point + 3 >= $max)->push($point + 3)
            ->when($point + 1 >= $max)->push($point + 1)
            ->when($iterate == 1 && $isLast && $point >= $max)->push($point);
    }

}
