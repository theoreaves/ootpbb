<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HumanManager extends Model
{
    protected $primaryKey = 'human_manager_id';
    public $incrementing = false;
    protected $guarded = [];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function lastTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'last_team_id');
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function lastLeague(): BelongsTo
    {
        return $this->belongsTo(League::class, 'last_league_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'organization_id');
    }

    public function lastOrganization(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'last_organization_id');
    }

    public function cityOfBirth(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_of_birth_id');
    }

    public function nation(): BelongsTo
    {
        return $this->belongsTo(Nation::class, 'nation_id');
    }

    public function secondNation(): BelongsTo
    {
        return $this->belongsTo(Nation::class, 'second_nation_id');
    }

    public function battingStats(): HasMany
    {
        return $this->hasMany(HumanManagerHistoryBattingStat::class, 'human_manager_id');
    }

    public function pitchingStats(): HasMany
    {
        return $this->hasMany(HumanManagerHistoryPitchingStat::class, 'human_manager_id');
    }

    public function fieldingStats(): HasMany
    {
        return $this->hasMany(HumanManagerHistoryFieldingStat::class, 'human_manager_id');
    }

    public function financials(): HasMany
    {
        return $this->hasMany(HumanManagerHistoryFinancial::class, 'human_manager_id');
    }

    public function records(): HasMany
    {
        return $this->hasMany(HumanManagerHistoryRecord::class, 'human_manager_id');
    }

    public function history(): HasMany
    {
        return $this->hasMany(HumanManagerHistory::class, 'human_manager_id');
    }
}
