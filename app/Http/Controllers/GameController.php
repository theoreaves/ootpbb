<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameLog;
use App\Models\League;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function boxscore($gameId)
    {
        $league_id = config('app.league_id');
        $league = League::where('league_id', $league_id)->first();
        $game = Game::with(['homeTeam', 'awayTeam', 'scores', 'batting', 'pitching', 'scorecard'])->findOrFail($gameId);

//        dump($game->homeTeam);
//        dump($game->awayTeam);
//        dump($game->scores);
//        dump($game->batting);
//        dump($game->pitching);
//        dump($game->scorecard);

//        return view('games.boxscore', compact('game'));
        return view('games.boxscore', [
            'league_id' => $league_id,
            'league' => $league,
            'game' => $game
        ]);
    }

    public function game_log($gameId)
    {
        $league_id = config('app.league_id');
        $league = League::where('league_id', $league_id)->first();
        $game = Game::with(['homeTeam', 'awayTeam', 'scores', 'batting', 'pitching', 'scorecard'])->findOrFail($gameId);
        $gameLog = GameLog::where('game_id', $gameId)
            ->orderBy('line')
            ->get();

//        return view('games.boxscore', compact('game'));
        return view('games.game_log', [
            'league_id' => $league_id,
            'league' => $league,
            'game' => $game,
            'gameLog' => $gameLog
        ]);
    }

}
