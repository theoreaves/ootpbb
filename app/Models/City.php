<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $primaryKey = 'city_id';
    public $incrementing = false;
    protected $guarded = [];

    public function nation(): BelongsTo
    {
        return $this->belongsTo(Nation::class, 'nation_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id', 'state_id'); // if `states` table exists
    }

    public function mainLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'main_language_id');
    }

    public function playersBornHere(): HasMany
    {
        return $this->hasMany(Player::class, 'city_of_birth_id');
    }

    public function coachesBornHere(): HasMany
    {
        return $this->hasMany(Coach::class, 'city_of_birth_id');
    }

    public function humanManagersBornHere(): HasMany
    {
        return $this->hasMany(HumanManager::class, 'city_of_birth_id');
    }
}
