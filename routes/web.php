<?php

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

Route::get('team/{team}', [TeamController::class, 'show'])->name('teams.show');
Route::get('team/{team}/roster', [TeamController::class, 'roster'])->name('teams.roster');
Route::get('team/{team}/schedule', [TeamController::class, 'schedule'])->name('teams.schedule');
Route::get('team/{team}/stats', [TeamController::class, 'stats'])->name('teams.stats');
Route::get('player/{player}', [PlayerController::class, 'show'])->name('players.show');

require __DIR__.'/auth.php';
