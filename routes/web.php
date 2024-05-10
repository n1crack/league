<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

// Fixture routes
Route::get('/', [FixtureController::class, 'create']);
Route::post('/', [FixtureController::class, 'store']);
// Simulation routes
Route::get('/simulation', [SimulationController::class, 'create']);
Route::post('/simulation', [SimulationController::class, 'store']);
