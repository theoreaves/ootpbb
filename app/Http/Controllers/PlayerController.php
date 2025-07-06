<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayersBatting;
use App\Models\PlayersCareerBattingStat;
use App\Models\PlayersCareerFieldingStat;
use App\Models\PlayersCareerPitchingStat;
use App\Models\PlayersPitching;
use App\Models\PlayersFielding;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show($playerId)
    {
        // Fetch player data from the database
        $player = Player::findOrFail($playerId);

        // Fetch team data if needed
        $team = $player->team; // Assuming Player model has a 'team' relationship

        // Fetch batting, pitching, and fielding stats
        $batting = $player->batting_stats()->where('split_id', 1)->orderBy('year', 'desc')->first();
        $pitching = $player->pitching_stats()->where('split_id', 1)->orderBy('year', 'desc')->first();
        $fielding = $player->fielding_stats()->orderBy('year', 'desc')->first();

        $careerBatting = PlayersCareerBattingStat::where('player_id', $playerId)
            ->where('split_id', 1)
            ->orderBy('year', 'asc')
            ->get();

        $careerPitching = PlayersCareerPitchingStat::where('player_id', $playerId)
            ->where('split_id', 1)
            ->orderBy('year', 'asc')
            ->get();

        $careerFielding = PlayersCareerFieldingStat::where('player_id', $playerId)
            ->orderBy('year', 'asc')
            ->get();

        $awards = $player->awards;   //->where('league_id', $player->team->league_id);

        return view('player.show', [
            'player' => $player,
            'team' => $team,
            'batting' => $batting,
            'pitching' => $pitching,
            'fielding' => $fielding,
            'careerBatting' => $careerBatting,
            'careerPitching' => $careerPitching,
            'careerFielding' => $careerFielding,
            'awards' => $awards,
        ]);
    }
}
