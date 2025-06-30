<?php

namespace App\Services;

use App\Models\PlayersCareerBattingStat;
use App\Models\PlayersCareerPitchingStat;
use Illuminate\Support\Collection;

class TeamStatRankingService
{
    protected $year;

    public function __construct($year = 2064)
    {
        $this->year = $year;
    }

    public function getRankings(): Collection
    {
        $batting = PlayersCareerBattingStat::where('year', $this->year)->get();
        $pitching = PlayersCareerPitchingStat::where('year', $this->year)->get();

        $teams = $batting->groupBy('team_id')->map(function ($players, $teamId) use ($pitching) {
            $teamPitching = $pitching->where('team_id', $teamId);
            $ab = $players->sum('ab');
            $h = $players->sum('h');
            $bb = $players->sum('bb');
            $hr = $players->sum('hr');
            $r = $players->sum('r');
            $war = $players->sum('war');

            $ip = $teamPitching->sum('ip');
            $er = $teamPitching->sum('er');

            return [
                'team_id' => $teamId,
                'runs' => $r,
                'avg' => $ab > 0 ? $h / $ab : 0,
                'obp' => $ab + $bb > 0 ? ($h + $bb) / ($ab + $bb) : 0,
                'ops' => $ab > 0 ? (($h + $bb) / ($ab + $bb)) + ($h / $ab) : 0,
                'war' => $war,
                'hr' => $hr,
                'era' => $ip > 0 ? ($er * 9) / $ip : 0,
            ];
        });

        // Rank each stat
        $rankings = collect(['runs', 'avg', 'obp', 'ops', 'war', 'hr', 'era'])->mapWithKeys(function ($stat) use ($teams) {
            $sorted = $teams->sortByDesc($stat)->values()->pluck('team_id');
            return [$stat . '_rankings' => $sorted->flip()->map(fn($i) => $i + 1)];
        });

        return $teams->map(function ($stats, $teamId) use ($rankings) {
            return [
                'team_id' => $teamId,
                'runs' => $stats['runs'],
                'avg' => $stats['avg'],
                'obp' => $stats['obp'],
                'ops' => $stats['ops'],
                'war' => $stats['war'],
                'hr' => $stats['hr'],
                'era' => $stats['era'],
                'rankings' => [
                    'runs' => $rankings['runs_rankings'][$teamId] ?? null,
                    'avg' => $rankings['avg_rankings'][$teamId] ?? null,
                    'obp' => $rankings['obp_rankings'][$teamId] ?? null,
                    'ops' => $rankings['ops_rankings'][$teamId] ?? null,
                    'war' => $rankings['war_rankings'][$teamId] ?? null,
                    'hr' => $rankings['hr_rankings'][$teamId] ?? null,
                    'era' => $rankings['era_rankings'][$teamId] ?? null,
                ]
            ];
        });
    }
}
