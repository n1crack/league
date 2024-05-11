<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SimulationController extends Controller
{

    public function create()
    {
        return Inertia::render('Simulation/Index', [
            'teams' => Team::all()
        ]);
    }

    public function store()
    {
        //
    }
}
