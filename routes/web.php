<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\SqlDumpController;
use App\Http\Controllers\UploadController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('standings', [HomeController::class, 'standings'])->name('home.standings');
Route::get('teams', [HomeController::class, 'teams'])->name('home.teams');

Route::get('team/{team}', [TeamController::class, 'show'])->name('teams.show');
Route::get('team/{team}/roster', [TeamController::class, 'roster'])->name('teams.roster');
Route::get('team/{team}/schedule', [TeamController::class, 'schedule'])->name('teams.schedule');
Route::get('team/{team}/stats', [TeamController::class, 'stats'])->name('teams.stats');
Route::get('team/{team}/stadium', [TeamController::class, 'stadium'])->name('teams.stadium');
Route::get('player/{player}', [PlayerController::class, 'show'])->name('players.show');

Route::get('/games/{game}/boxscore', [GameController::class, 'boxscore'])->name('games.boxscore');
Route::get('/games/{game}/game_log', [GameController::class, 'game_log'])->name('games.game_log');

Route::post('/upload-sql-zip', [SqlDumpController::class, 'upload'])->name('upload-zip-import');
Route::get('/upload-zip', [UploadController::class, 'index'])->name('upload-sql-zip');

require __DIR__.'/auth.php';
