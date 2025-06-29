<?php

namespace App\Http\Controllers;

use App\Models\PlayersCareerBattingStat;
use App\Models\PlayersCareerFieldingStat;
use App\Models\PlayersCareerPitchingStat;
use App\Models\Team;
use App\Models\TeamRoster;
use App\Models\Player;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function show($teamId)
    {
        $team = Team::findOrFail($teamId);

        // Get rostered players for this team
        $rosterPlayerIds = TeamRoster::where('team_id', $teamId)->pluck('player_id');
        $players = Player::whereIn('player_id', $rosterPlayerIds)
            ->orderBy('position')
            ->get();

        // Group players by role
        $grouped = [
            'Pitchers' => $players->where('position', 1),
            'Catchers' => $players->where('position', 2),
            'Infielders' => $players->whereIn('position', [3, 4, 5, 6]),
            'Outfielders' => $players->whereIn('position', [7, 8, 9]),
        ];

        return view('team.show', [
            'team' => $team,
            'grouped' => $grouped,
        ]);
    }

    public function roster($teamId)
    {
        $team = Team::findOrFail($teamId);

        // Get rostered players for this team
        $rosterPlayerIds = TeamRoster::where('team_id', $teamId)->pluck('player_id');
        $players = Player::whereIn('player_id', $rosterPlayerIds)
            ->orderBy('position')
            ->get();

        // Group players by role
        $grouped = [
            'Pitchers' => $players->where('position', 1),
            'Catchers' => $players->where('position', 2),
            'Infielders' => $players->whereIn('position', [3, 4, 5, 6]),
            'Outfielders' => $players->whereIn('position', [7, 8, 9]),
        ];

        return view('team.roster.show', [
            'team' => $team,
            'grouped' => $grouped,
        ]);
    }

    public function stats(Request $request, $teamId)
    {
        $team = Team::findOrFail($teamId);
        $split = $request->query('split', 1);
        $year = $request->query('year', 2064); // Default year

        // Get all distinct years from batting stats table (assumes all tables have similar years)
        $availableYears = DB::table('players_career_batting_stats')
            ->select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        $battingStats = PlayersCareerBattingStat::with('player')
            ->where('team_id', $teamId)
            ->where('year', $year)
            ->where('split_id', $split)
            ->get();

        $pitchingStats = PlayersCareerPitchingStat::with('player')
            ->where('team_id', $teamId)
            ->where('year', $year)
            ->where('split_id', $split)
            ->get();

        $fieldingStats = PlayersCareerFieldingStat::with('player')
            ->where('team_id', $teamId)
            ->where('year', $year)
            ->where('split_id', $split)
            ->get();

        return view('team.stats', compact(
            'team',
            'battingStats',
            'pitchingStats',
            'fieldingStats',
            'split',
            'year',
            'availableYears'
        ));
    }

    public function stats1($teamId)
    {
        $team = Team::findOrFail($teamId);
        $battingStats = PlayersCareerBattingStat::where('team_id', $teamId)
            ->where('year', 2064)
            ->where('split_id', 1) // Assuming split_id 1 is for full season stats
            ->get();
        $pitchingStats = PlayersCareerPitchingStat::where('team_id', $teamId)
            ->where('year', 2064)
            ->where('split_id', 1) // Assuming split_id 1 is for full season stats
            ->get();
        $fieldingStats = PlayersCareerFieldingStat::where('team_id', $teamId)
            ->where('year', 2064)
//            ->where('split_id', 1) // Assuming split_id 1 is for full season stats
            ->get();


        // Get all games where this team is home or away, ordered by date
        return view('team.stats', [
            'team' => $team,
            'battingStats' => $battingStats,
            'pitchingStats' => $pitchingStats,
            'fieldingStats' => $fieldingStats,
        ]);
    }

    public function schedule(Request $request, $teamId)
    {
        $team = Team::findOrFail($teamId);

        $monthParam = $request->query('month');

        // Get all games for the team
        $games = Game::where(function ($query) use ($teamId) {
            $query->where('home_team', $teamId)
                ->orWhere('away_team', $teamId);
        })
            ->orderBy('date')
            ->get();

        // Determine month to show
        if ($monthParam) {
            $month = Carbon::parse($monthParam)->startOfMonth();
        } elseif ($games->count()) {
            $month = Carbon::parse($games->first()->date)->startOfMonth();
        } else {
            $month = now()->startOfMonth();
        }

        $gamesInMonth = $games->filter(function ($game) use ($month) {
            $date = Carbon::parse($game->date);
            return $date->month === $month->month && $date->year === $month->year;
        });

        $gamesByDate = $gamesInMonth->groupBy(fn($game) => Carbon::parse($game->date)->toDateString());
        return view('team.schedule-calendar', compact('team', 'gamesByDate', 'month'));
    }
}
