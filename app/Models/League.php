<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    protected $primaryKey = 'league_id';
    public $incrementing = false;
    protected $guarded = [];

    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class, 'league_id');
    }

    public function playoffFixtures(): HasMany
    {
        return $this->hasMany(LeaguePlayoffFixture::class, 'league_id');
    }

    public function playoffs(): HasMany
    {
        return $this->hasMany(LeaguePlayoff::class, 'league_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(LeagueEvent::class, 'league_id');
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'league_id');
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'league_id');
    }

    public function managers(): HasMany
    {
        return $this->hasMany(HumanManager::class, 'league_id');
    }

    public function managerHistories(): HasMany
    {
        return $this->hasMany(HumanManagerHistory::class, 'league_id');
    }
}
