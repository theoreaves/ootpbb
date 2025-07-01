<?php

namespace App\Http\Controllers;

use App\Models\PlayersCareerBattingStat;
use App\Models\PlayersCareerFieldingStat;
use App\Models\PlayersCareerPitchingStat;
use App\Models\Team;
use App\Models\TeamRoster;
use App\Models\Player;
use App\Models\Game;
use App\Models\TeamRecord;
use App\Models\SubLeague;
use App\Services\OotpSeasonService;
use App\Services\TeamStatRankingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function show($teamId)
    {
        $team = Team::findOrFail($teamId);


        $currentYear = OotpSeasonService::currentYear();

        $battingLeaders = PlayersCareerBattingStat::with('player')
            ->where('team_id', $teamId)
            ->where('split_id', 1)
            ->where('year', $currentYear)
            ->get();
        $battingLeadersByAvg = $battingLeaders
            ->filter(fn($s) => $s->g > 0 && ($s->ab / $s->g) >= 3)
            ->sortByDesc(fn($s) => $s->ab > 0 ? $s->h / $s->ab : 0)
            ->take(3);
        $battingLeadersByHr = $battingLeaders->sortByDesc('hr')->take(3);
        $battingLeadersByRbi = $battingLeaders->sortByDesc('rbi')->take(3);
        $battingLeadersBySb = $battingLeaders->sortByDesc('sb')->take(3);

        $pitchingLeaders = PlayersCareerPitchingStat::with('player')
            ->where('team_id', $teamId)
            ->where('split_id', 1)
            ->where('year', $currentYear)
            ->get();
        $pitchingLeadersByEra = $pitchingLeaders
            ->filter(fn($s) => $s->g > 0 && ($s->ip / $s->g) >= 1)
            ->sortBy(fn($s) => $s->ip > 0 ? ($s->er * 9) / $s->ip : INF)
            ->take(3);
        $pitchingLeadersByWins = $pitchingLeaders->sortByDesc('w')->take(3);
        $pitchingLeadersByStrikeouts = $pitchingLeaders->sortByDesc('k')->take(3);
        $pitchingLeadersByIp = $pitchingLeaders->sortByDesc('ip')->take(3);


        // Fetch last 3 games where played is 1 and next 3 games where played is not 1
        $lastGames = Game::where(function ($query) use ($teamId) {
            $query->where('home_team', $teamId)
                ->orWhere('away_team', $teamId);
        })
            ->where('played', 1)
            ->orderByDesc('date')
            ->limit(3)
            ->get()
            ->reverse(); // So they are in chronological order

        $nextGames = Game::where(function ($query) use ($teamId) {
            $query->where('home_team', $teamId)
                ->orWhere('away_team', $teamId);
        })
            ->where('played', '!=', 1)
            ->orderBy('date')
            ->limit(3)
            ->get();

        // Get standings for the team's subleague
        $subleagueId = $team->sub_league_id;
        $subleague = SubLeague::where('sub_league_id', $subleagueId)->first();
        $standings = TeamRecord::with('team')
            ->whereHas('team', function ($query) use ($team, $subleagueId) {
                $query->where('sub_league_id', $subleagueId)
                    ->where('league_id', $team->league_id)
                    ->where('allstar_team', '!=', 1);
            })
            ->orderBy('pos')
            ->get();

        $rankingService = new TeamStatRankingService($currentYear);
        $rankings = $rankingService->getRankings();
        $teamStats = $rankings[$teamId] ?? null;


//        return view('team.show', [
//            'team' => $team,
//            'grouped' => $grouped,
//            'lastGames' => $lastGames,
//            'nextGames' => $nextGames,
//            'subleague' => $subleague,
//            'standings' => $standings,
//            'teamStats' => $teamStats,
//
//        ]);

        return view('team.show', compact(
            'team', 'lastGames', 'nextGames', 'subleague', 'standings',
            'battingLeadersByAvg', 'battingLeadersByHr', 'battingLeadersByRbi', 'battingLeadersBySb',
            'teamStats',
            'pitchingLeadersByEra', 'pitchingLeadersByWins', 'pitchingLeadersByStrikeouts', 'pitchingLeadersByIp'
        ));


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

        $currentYear = OotpSeasonService::currentYear();
        $year = $request->query('year', $currentYear); // Default year

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

        $currentYear = OotpSeasonService::currentYear();

        $battingStats = PlayersCareerBattingStat::where('team_id', $teamId)
            ->where('year', $currentYear)
            ->where('split_id', 1) // Assuming split_id 1 is for full season stats
            ->get();
        $pitchingStats = PlayersCareerPitchingStat::where('team_id', $teamId)
            ->where('year', $currentYear)
            ->where('split_id', 1) // Assuming split_id 1 is for full season stats
            ->get();
        $fieldingStats = PlayersCareerFieldingStat::where('team_id', $teamId)
            ->where('year', $currentYear)
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
            // Find the first game not played
            $firstNotPlayed = $games->first(function ($game) {
                return $game->played != 1;
            });
            if ($firstNotPlayed) {
                $month = Carbon::parse($firstNotPlayed->date)->startOfMonth();
            } else {
                $month = Carbon::parse($games->first()->date)->startOfMonth();
            }
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


    public function stadium($teamId)
    {
        $team = Team::findOrFail($teamId);


        return view('team.stadium', compact('team'));
    }
}
