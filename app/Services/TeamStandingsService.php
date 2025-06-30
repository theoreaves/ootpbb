<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Team;
use App\Models\TeamRecord;
use Illuminate\Support\Collection;

class TeamStandingsService
{
    public function getExpandedStandings(int $league_id, int $year): Collection
    {
        $teams = Team::where('league_id', $league_id)
            ->where('allstar_team', '!=', 1)
            ->get();

        return $teams->map(function ($team) use ($year) {
            $record = TeamRecord::where('team_id', $team->team_id)
                ->first();

            $games = Game::whereYear('date', $year)
                ->where(function ($q) use ($team) {
                    $q->where('home_team', $team->team_id)
                        ->orWhere('away_team', $team->team_id);
                })
                ->where('played', 1)
                ->orderByDesc('date')
                ->get();

            $last10 = $games->take(10);
            $last10Wins = $last10->filter(function ($game) use ($team) {
                return (
                    ($game->home_team == $team->team_id && $game->runs1 > $game->runs0) ||
                    ($game->away_team == $team->team_id && $game->runs0 > $game->runs1)
                );
            })->count();

            $streak = $this->calculateStreak($games, $team->team_id);

            $homeGames = $games->filter(fn($g) => $g->home_team == $team->team_id);
            $homeWins = $homeGames->filter(fn($g) => $g->runs1 > $g->runs0)->count();

            $awayGames = $games->filter(fn($g) => $g->away_team == $team->team_id);
            $awayWins = $awayGames->filter(fn($g) => $g->runs0 > $g->runs1)->count();

            $runsScored = $games->sum(fn($g) => $g->home_team == $team->team_id ? $g->runs1 : $g->runs0);
            $runsAllowed = $games->sum(fn($g) => $g->home_team == $team->team_id ? $g->runs0 : $g->runs1);

            return (object) [
                'team_id' => $team->team_id,
                'record' => $record,
                'home_record' => $homeWins . '-' . ($homeGames->count() - $homeWins),
                'away_record' => $awayWins . '-' . ($awayGames->count() - $awayWins),
                'last10' => $last10Wins . '-' . (10 - $last10Wins),
                'run_diff' => $runsScored - $runsAllowed,
                'streak' => $streak,
            ];
        })->sortByDesc(fn($t) => $t->record->w ?? 0)->values();
    }

    private function calculateStreak(Collection $games, int $teamId): string
    {
        $streak = 0;
        $lastResult = null;

        foreach ($games as $game) {
            $won = (
                ($game->home_team == $teamId && $game->runs1 > $game->runs0) ||
                ($game->away_team == $teamId && $game->runs0 > $game->runs1)
            );

            if ($lastResult === null || $won === $lastResult) {
                $streak++;
                $lastResult = $won;
            } else {
                break;
            }
        }

        return ($lastResult ? 'W' : 'L') . $streak;
    }
}
