<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamRoster;
use App\Models\Player;

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
}
