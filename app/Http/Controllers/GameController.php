<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function boxscore($gameId)
    {
        $game = Game::with(['homeTeam', 'awayTeam', 'scores', 'batting', 'pitching', 'scorecard'])->findOrFail($gameId);

//        dump($game->homeTeam);
//        dump($game->awayTeam);
//        dump($game->scores);
//        dump($game->batting);
//        dump($game->pitching);
//        dump($game->scorecard);

        return view('games.boxscore', compact('game'));
    }

}
