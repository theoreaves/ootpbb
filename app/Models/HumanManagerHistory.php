<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HumanManagerHistory extends Model
{
    protected $table = 'human_manager_history';
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
        return $this->belongsTo(SubLeague::class, 'sub_league_id'); // assumed table
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id'); // assumed to be meaningful in context
    }

    public function bestHitter(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'best_hitter_id');
    }

    public function bestPitcher(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'best_pitcher_id');
    }

    public function bestRookie(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'best_rookie_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Coach::class, 'manager_id'); // guessing from context — could be `HumanManager` too
    }
}
