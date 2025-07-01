<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameLog extends Model
{
    protected $guarded = [];

    public function game()
    {
        return $this->hasMany(Game::class, 'game_id', 'game_id');
    }

    public function getTextConvertedAttribute()
    {
        return preg_replace_callback(
            '/<a href="\.\.\/players\/player_(\d+)\.html">([^<]+)<\/a>/',
            function ($matches) {
                $playerId = ltrim($matches[1], '0'); // remove leading zeros if needed
                $name = $matches[2];
                return "<a class='hover:text-blue-500 underline' href=\"/player/{$playerId}\">{$name}</a>";
            },
            $this->text
        );
    }
}
