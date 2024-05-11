<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

// Fixture routes
Route::get('/', [GameController::class, 'index'])->name('games.index');
Route::post('/games', [GameController::class, 'store'])->name('games.store');
// Simulation routes
Route::get('/simulation', [SimulationController::class, 'create'])->name('simulation.create');
Route::post('/simulation', [SimulationController::class, 'store']);


Route::get('/team', [TeamController::class, 'index'])->name('team.index');
Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
Route::post('/team/create', [TeamController::class, 'store']);
Route::delete('/team/{team}', [TeamController::class, 'destroy'])->name('team.destroy');

