<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $primaryKey = 'language_id';
    public $incrementing = false;
    protected $guarded = [];

    public function languageData(): HasMany
    {
        return $this->hasMany(LanguageData::class, 'language_id');
    }

    public function nations(): HasMany
    {
        return $this->hasMany(Nation::class, 'main_language_id');
    }

    public function continents(): HasMany
    {
        return $this->hasMany(Continent::class, 'main_language_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'main_language_id');
    }
}
