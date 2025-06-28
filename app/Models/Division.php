<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Division extends Model
{
    protected $primaryKey = ['league_id', 'sub_league_id', 'division_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    // You might want to override this if you're using composite keys in Eloquent:
    // Laravel doesn't support composite primary keys out of the box

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function subLeague(): BelongsTo
    {
        return $this->belongsTo(SubLeague::class, 'sub_league_id'); // Assuming you have this model/table
    }
}
