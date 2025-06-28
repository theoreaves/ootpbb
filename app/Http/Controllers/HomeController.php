<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamRecord;
use App\Models\SubLeague;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch standings for League ID 200, excluding "All-Stars"
        $standings = TeamRecord::with(['team' => function ($query) {
            $query->where('nickname', '!=', 'All-Stars');
        }])
            ->whereHas('team', function ($query) {
                $query->where('league_id', 200)
                    ->where('nickname', '!=', 'All-Stars');
            })
            ->orderBy('pos')
            ->get();

        // Get subleague ids and league ids for lookup
        $subleagues = SubLeague::where('league_id', 200)->get();

        // Group standings by composite key
        $groupedStandings = $standings->groupBy(function ($record) {
            return $record->team->sub_league_id;
        });

        return view('welcome', [
            'groupedStandings' => $groupedStandings,
            'subleagues' => $subleagues
        ]);
    }
}

