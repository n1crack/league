<?php

namespace App\Services;

use Illuminate\Support\Collection;

class ChampionshipPredictor
{
    public static function predict(Collection $pts, $weeks_left): Collection
    {

        // if the championship is over or there are more than 3 weeks left, return empty

        // max point, it can be the championship point. we don't know that yet.
        $max = $pts->max();

        // next rounds predictions for each point
        $predictions = self::predictNextRoundsPoints($pts, $max, $weeks_left);

        // total result count
        $totalResult = $predictions->flatten()->count();


        // calculate the percentage of each item
        return $predictions->map(function($item) use ($totalResult) {
            return round(collect($item)->flatten()->count() / $totalResult * 100, 2);
        });
    }

    public static function predictNextRoundsPoints($points, $max, $iterate): Collection
    {
        $predictions = [];
        $isFirst = true;
        foreach ($points as $key => $sayi) {
            $predictions[$key][$sayi] = [];

            array_push($predictions[$key][$sayi], ...self::addPoints($sayi, $max, $iterate, $isFirst));
            $isFirst = false;
        }
        return collect($predictions);
    }

    public static function addPoints($point, $max, $iterate, $isFirst): Collection
    {
        $results = collect();
        // recursive call
        if ($iterate > 1) {
            $iterate--;
            $results->push(...self::addPoints($point + 3, $max, $iterate, $isFirst));
            $results->push(...self::addPoints($point + 1, $max, $iterate, $isFirst));
        }

        return $results
            ->when($point + 3 >= $max)->push($point + 3)
            ->when($point + 1 >= $max)->push($point + 1)
            ->when($iterate == 1 && $isFirst && $point >= $max)->push($point);
    }

}
