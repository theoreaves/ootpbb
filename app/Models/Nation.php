<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nation extends Model
{
    protected $primaryKey = 'nation_id';
    public $incrementing = false;
    protected $guarded = [];

    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class, 'continent_id');
    }

    public function mainLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'main_language_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'nation_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, 'nation_id');
    }

    public function secondNationPlayers(): HasMany
    {
        return $this->hasMany(Player::class, 'second_nation_id');
    }

    public function coaches(): HasMany
    {
        return $this->hasMany(Coach::class, 'nation_id');
    }

    public function humanManagers(): HasMany
    {
        return $this->hasMany(HumanManager::class, 'nation_id');
    }

    public function secondNationManagers(): HasMany
    {
        return $this->hasMany(HumanManager::class, 'second_nation_id');
    }
}
