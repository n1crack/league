<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayGameController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

// Fixture routes
Route::get('/', [GameController::class, 'index'])->name('games.index');
Route::post('/games', [GameController::class, 'store'])->name('games.store');
// Simulation routes
Route::get('/simulation', [SimulationController::class, 'create'])->name('simulation.create');

// Play the game routes
Route::post('/play-the-game', [PlayGameController::class, 'store'])->name('play-the-game');
Route::post('/reset-the-game', [PlayGameController::class, 'destroy'])->name('reset-the-game');

Route::get('/team', [TeamController::class, 'index'])->name('team.index');
Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
Route::post('/team/create', [TeamController::class, 'store']);
Route::delete('/team/{team}', [TeamController::class, 'destroy'])->name('team.destroy');

