<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $primaryKey = 'player_id';
    public $incrementing = false;
    protected $guarded = [];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function nation(): BelongsTo
    {
        return $this->belongsTo(Nation::class, 'nation_id');
    }

    public function secondNation(): BelongsTo
    {
        return $this->belongsTo(Nation::class, 'second_nation_id');
    }

    public function cityOfBirth(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_of_birth_id');
    }

    public function leagueEvents(): HasMany
    {
        return $this->hasMany(LeagueEvent::class, 'player_id');
    }

    public function formerCoachings(): HasMany
    {
        return $this->hasMany(Coach::class, 'former_player_id');
    }
}
