<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\League;
use App\Models\Message;
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
            'games' => $games
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

        // Get subleague ids and league ids for lookup
        $subleagues = SubLeague::where('league_id', $league_id)->get();

        // Group standings by composite key
        $groupedStandings = $standings->groupBy(function ($record) {
            return $record->team->sub_league_id;
        });

        return view('standings', [
            'groupedStandings' => $groupedStandings,
            'league' => $league,
            'subleagues' => $subleagues
        ]);
    }


}

