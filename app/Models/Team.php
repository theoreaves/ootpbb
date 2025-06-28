<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    protected $primaryKey = 'team_id';
    public $incrementing = false;
    protected $guarded = [];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    public function coaches(): HasMany
    {
        return $this->hasMany(Coach::class, 'team_id');
    }

    public function managers(): HasMany
    {
        return $this->hasMany(HumanManager::class, 'team_id');
    }

    public function homeFixtures(): HasMany
    {
        return $this->hasMany(LeaguePlayoffFixture::class, 'home_team_id');
    }

    public function awayFixtures(): HasMany
    {
        return $this->hasMany(LeaguePlayoffFixture::class, 'away_team_id');
    }

    public function wonFixtures(): HasMany
    {
        return $this->hasMany(LeaguePlayoffFixture::class, 'winner_team_id');
    }

    public function managerHistories(): HasMany
    {
        return $this->hasMany(HumanManagerHistory::class, 'team_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(LeagueEvent::class, 'team_id');
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'team_id'); // If `team_id` appears in games table
    }
}
