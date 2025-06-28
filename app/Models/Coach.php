<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coach extends Model
{
    protected $primaryKey = 'coach_id';
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

    public function cityOfBirth(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_of_birth_id');
    }

    public function formerPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'former_player_id');
    }
}
