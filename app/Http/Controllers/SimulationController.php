<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SimulationController extends Controller
{

    public function create()
    {
        return Inertia::render('Simulation/Index');
    }

    public function store()
    {
        //
    }
}
