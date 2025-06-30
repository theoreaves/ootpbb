<?php
// app/Services/OotpSeasonService.php
namespace App\Services;

use App\Models\Game;
use Illuminate\Support\Facades\DB;

class OotpSeasonService
{
    public static function currentYear(): int
    {
        return Game::max(DB::raw('YEAR(date)')) ?? now()->year;
    }
}
