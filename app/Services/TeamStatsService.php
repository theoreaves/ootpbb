<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TeamStatsService
{
    protected int $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function getTeamStats(): array
    {
        $stats = DB::table('team_batting_stats as tbs')
            ->join('team_pitching_stats as tps', 'tbs.team_id', '=', 'tps.team_id')
            ->select(
                'tbs.team_id',
                DB::raw('SUM(tbs.r) as runs_scored'),
                DB::raw('ROUND(SUM(tbs.h) / NULLIF(SUM(tbs.ab), 0), 3) as avg'),
                DB::raw('ROUND(SUM(tbs.h + tbs.bb + tbs.hbp) / NULLIF(SUM(tbs.ab + tbs.bb + tbs.hbp + tbs.sf), 0), 3) as obp'),
                DB::raw('(ROUND(SUM(tbs.h + tbs.bb + tbs.hbp) / NULLIF(SUM(tbs.ab + tbs.bb + tbs.hbp + tbs.sf), 0), 3) +
                          ROUND((SUM(tbs.h - tbs.d - tbs.t - tbs.hr) + 2 * SUM(tbs.d) + 3 * SUM(tbs.t) + 4 * SUM(tbs.hr)) / NULLIF(SUM(tbs.ab), 0), 3)) as ops'),
                DB::raw('SUM(tbs.war) as batting_war'),
                DB::raw('ROUND(AVG(tbs.woba), 3) as woba'),
                DB::raw('SUM(tbs.hr) as home_runs'),
                DB::raw('SUM(tbs.sb) as stolen_bases'),
                DB::raw('SUM(tbs.br) as base_running'),
                DB::raw('SUM(tps.ra) as runs_against'),
                DB::raw('ROUND(SUM(tps.er) * 9 / NULLIF(SUM(tps.ip), 0), 2) as starters_era'),
                DB::raw('ROUND(SUM(tps.er) * 9 / NULLIF(SUM(tps.ip), 0), 2) as bullpen_era')
            )
            ->where('tbs.year', $this->year)
            ->where('tps.year', $this->year)
            ->groupBy('tbs.team_id')
            ->get()
            ->keyBy('team_id')
            ->toArray();

        return $stats;
    }

    public function getRankings(array $stats, string $key, bool $descending = true): array
    {
        $sorted = collect($stats)->sortBy($key, SORT_REGULAR, $descending)->values();

        return $sorted->mapWithKeys(function ($item, $index) use ($key) {
            return [$item->team_id => [
                'value' => $item->$key,
                'rank' => $index + 1
            ]];
        })->toArray();
    }
}
