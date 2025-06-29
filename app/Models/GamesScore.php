<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GamesScore extends Model
{
    protected $table = 'games_score';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = ['game_id', 'team', 'inning']; // composite
    protected $guarded = [];

    // Composite keys aren't natively supported by Eloquent,
    // so be cautious with updates/deletes unless using a custom trait.

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team'); // assuming `team` maps to `teams.team_id`
    }
}
