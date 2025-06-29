<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $primaryKey = 'game_id';
    public $incrementing = false;
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team', 'team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team', 'team_id');
    }

    public function scores(): HasMany
    {
        return $this->hasMany(GamesScore::class, 'game_id', 'game_id');
    }

    public function batting(): HasMany
    {
        return $this->hasMany(PlayersGameBatting::class, 'game_id', 'game_id');
    }

    public function pitching()
    {
        return $this->hasMany(PlayersGamePitchingStat::class, 'game_id', 'game_id');
    }

    public function scorecard()
    {
        return $this->hasMany(PlayersAtBatBattingStat::class, 'game_id', 'game_id');
    }


}
