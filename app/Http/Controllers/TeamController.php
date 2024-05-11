<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'strength' => 'required|integer',
        ]);

        $team = Team::query()->create($validated);

        // return for Inertia
         return to_route('home');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        // return for Inertia
        return to_route('home');
    }
}
