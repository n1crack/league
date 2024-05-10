<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FixtureController extends Controller
{
    public function create()
    {
        return Inertia::render('Fixture/Index');
    }


    public function store()
    {
        //
    }
}
