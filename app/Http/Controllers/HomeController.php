<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\League;
use App\Models\Message;
use App\Models\PlayersCareerBattingStat;
use App\Models\PlayersCareerPitchingStat;
use App\Models\Team;
use App\Services\OotpSeasonService;
use App\Services\TeamStandingsService;
use Illuminate\Http\Request;
use App\Models\TeamRecord;
use App\Models\SubLeague;

class HomeController extends Controller
{
    public function index()
    {
        $league_id = config('app.league_id');
        $league = League::where('league_id', $league_id)->first();
        $standings = TeamRecord::with(['team' => function ($query) {
            $query->where('allstar_team', '!=', 1);
        }])
            ->whereHas('team', function ($query) use ($league_id) {
                $query->where('league_id', $league_id)
                    ->where('allstar_team', '!=', 1);
            })
            ->orderBy('pos')
            ->get();


        $currentYear = OotpSeasonService::currentYear();

        $teamGamesPlayed = Game::where('league_id', $league_id)
            ->where('game_type', 0)
            ->where('played', 1)
            ->selectRaw('COUNT(DISTINCT date) as total')
            ->first()
            ->total ?? 0;

        $battingLeaders = PlayersCareerBattingStat::with('player')
            ->where('split_id', 1)
            ->where('league_id', $league_id)
            ->where('year', $currentYear)
            ->get();
//        $battingLeadersByAvg = $battingLeaders
//            ->filter(fn($s) => $s->g > 0 && ($s->ab / $s->g) >= 3)
//            ->sortByDesc(fn($s) => $s->ab > 0 ? $s->h / $s->ab : 0)
//            ->take(3);

        $battingLeadersByAvg = $battingLeaders
            ->filter(fn($s) => $teamGamesPlayed > 0 && ($s->ab / $teamGamesPlayed) >= 3)
            ->sortByDesc(fn($s) => $s->ab > 0 ? $s->h / $s->ab : 0)
            ->take(3);

        $battingLeadersByHr = $battingLeaders->sortByDesc('hr')->take(3);
        $battingLeadersByRbi = $battingLeaders->sortByDesc('rbi')->take(3);
        $battingLeadersBySb = $battingLeaders->sortByDesc('sb')->take(3);

        $pitchingLeaders = PlayersCareerPitchingStat::with('player')
            ->where('split_id', 1)
            ->where('league_id', $league_id)
            ->where('year', $currentYear)
            ->get();
        $pitchingLeadersByEra = $pitchingLeaders
            ->filter(fn($s) => $s->g > 0 && ($s->ip / $s->g) >= 1)
            ->sortBy(fn($s) => $s->ip > 0 ? ($s->er * 9) / $s->ip : INF)
            ->take(3);
        $pitchingLeadersByWins = $pitchingLeaders->sortByDesc('w')->take(3);
        $pitchingLeadersByStrikeouts = $pitchingLeaders->sortByDesc('k')->take(3);
        $pitchingLeadersByIp = $pitchingLeaders->sortByDesc('ip')->take(3);






        // Get subleague ids and league ids for lookup
        $subleagues = SubLeague::where('league_id', $league_id)->get();

        // Group standings by composite key
        $groupedStandings = $standings->groupBy(function ($record) {
            return $record->team->sub_league_id;
        });

        $games = Game::where('league_id', $league_id)
            ->where('played', 1)
            ->orderBy('date', 'desc')
            ->take(6)
            ->get();

        return view('welcome', [
            'groupedStandings' => $groupedStandings,
            'league' => $league,
            'subleagues' => $subleagues,
            'games' => $games,
            'battingLeadersByAvg' => $battingLeadersByAvg,
            'battingLeadersByHr' => $battingLeadersByHr,
            'battingLeadersByRbi' => $battingLeadersByRbi,
            'battingLeadersBySb' => $battingLeadersBySb,
            'pitchingLeadersByEra' => $pitchingLeadersByEra,
            'pitchingLeadersByWins' => $pitchingLeadersByWins,
            'pitchingLeadersByStrikeouts' => $pitchingLeadersByStrikeouts,
            'pitchingLeadersByIp' => $pitchingLeadersByIp,
        ]);
    }

    public function standings()
    {
        $league_id = config('app.league_id');
        $league = League::where('league_id', $league_id)->first();
        $standings = TeamRecord::with(['team' => function ($query) {
            $query->where('allstar_team', '!=', 1);
        }])
            ->whereHas('team', function ($query) use ($league_id) {
                $query->where('league_id', $league_id)
                    ->where('allstar_team', '!=', 1);
            })
            ->orderBy('pos')
            ->get();


        $currentYear = OotpSeasonService::currentYear();
        $standingsService = new TeamStandingsService();
        $expandedStandings = $standingsService->getExpandedStandings($league_id, $currentYear);
//        dump($expandedStandings);

        // Get subleague ids and league ids for lookup
        $subleagues = SubLeague::where('league_id', $league_id)->get();

        // Group standings by composite key
        $groupedStandings = $standings->groupBy(function ($record) {
            return $record->team->sub_league_id;
        });

        return view('standings', [
            'groupedStandings' => $groupedStandings,
            'league' => $league,
            'expandedStandings' => $expandedStandings,
            'subleagues' => $subleagues
        ]);
    }

    public function teams()
    {
        $league_id = config('app.league_id');
        $league = League::where('league_id', $league_id)->first();


        $teams = Team::where('league_id', $league_id)
            ->where('allstar_team', '!=', 1)
            ->orderBy('sub_league_id')->orderBy('name')->get();
        $teamsBySubleague = $teams->groupBy('sub_league_id');


        $subleagues = SubLeague::where('league_id', $league_id)->get();
        $teams = $league->teams()
            ->where('allstar_team', '!=', 1)
            ->orderby('sub_league_id')
            ->orderBy('name')
            ->get();

        // Group standings by composite key
        return view('teams', [
            'league' => $league,
            'teams' => $teams,
            'teamsBySubleague' => $teamsBySubleague,
            'subleagues' => $subleagues
        ]);
    }


}

