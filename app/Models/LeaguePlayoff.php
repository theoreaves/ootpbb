<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaguePlayoff extends Model
{
    protected $table = 'league_playoff';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function fixtures(): HasMany
    {
        return $this->hasMany(LeaguePlayoffFixture::class, 'league_id', 'league_id');
    }
}
