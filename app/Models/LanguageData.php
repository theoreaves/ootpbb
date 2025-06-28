<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LanguageData extends Model
{
    protected $table = 'language_data';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
