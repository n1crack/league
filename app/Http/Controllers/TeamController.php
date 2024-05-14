<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function index()
    {
        return Inertia::render('Team/Index', [
            'teams' => Team::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Team/Create');
    }

    public function store(CreateTeamRequest $request)
    {
        Team::query()->create($request->validated());

        // return for Inertia
        return to_route('team.index');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        // return for Inertia
        return to_route('team.index');
    }
}
