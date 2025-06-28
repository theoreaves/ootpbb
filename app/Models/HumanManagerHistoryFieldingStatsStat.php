<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HumanManagerHistoryFieldingStat extends Model
{
    protected $table = 'human_manager_history_fielding_stats_stats';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function humanManager(): BelongsTo
    {
        return $this->belongsTo(HumanManager::class, 'human_manager_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function subLeague(): BelongsTo
    {
        return $this->belongsTo(SubLeague::class, 'sub_league_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
