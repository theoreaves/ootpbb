<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Continent extends Model
{
    protected $primaryKey = 'continent_id';
    public $incrementing = false;
    protected $guarded = [];

    public function nations(): HasMany
    {
        return $this->hasMany(Nation::class, 'continent_id');
    }

    public function mainLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'main_language_id');
    }
}
