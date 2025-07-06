<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $primaryKey = 'player_id';
    public $incrementing = false;
    protected $guarded = [];

    protected $casts = [
        'player_id' => 'int',
        'team_id' => 'int',
        'nation_id' => 'int',
        'second_nation_id' => 'int',
        'city_of_birth_id' => 'int',
        'position' => 'int',
        'height' => 'int',
        'weight' => 'int',
        'bats' => 'string',
        'throws' => 'string',
        'date_of_birth' => 'datetime',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function nation(): BelongsTo
    {
        return $this->belongsTo(Nation::class, 'nation_id');
    }

    public function secondNation(): BelongsTo
    {
        return $this->belongsTo(Nation::class, 'second_nation_id');
    }

    public function cityOfBirth(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_of_birth_id');
    }

    public function leagueEvents(): HasMany
    {
        return $this->hasMany(LeagueEvent::class, 'player_id');
    }

    public function formerCoachings(): HasMany
    {
        return $this->hasMany(Coach::class, 'former_player_id');
    }

    public function awards(): HasMany
    {
        return $this->hasMany(PlayersAward::class, 'player_id', 'player_id');
    }
    public function batting_stats()
    {
        return $this->hasMany(PlayersCareerBattingStat::class, 'player_id');
    }

    public function pitching_stats()
    {
        return $this->hasMany(PlayersCareerPitchingStat::class, 'player_id');
    }

    public function fielding_stats()
    {
        return $this->hasMany(PlayersCareerFieldingStat::class, 'player_id');
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getHeightFtInchesAttribute()
    {
        if (! $this->height) {
            return null;
        }

        $inches = round($this->height / 2.54);
        $feet = floor($inches / 12);
        $remainingInches = $inches % 12;

        return "{$feet}′{$remainingInches}″";
    }
    public function getBatsTextAttribute()
    {
        $bats = [
            1 => 'Right',
            2 => 'Left',
            3 => 'Switch',
        ];
        return $bats[$this->bats] ?? 'Unknown';
    }

    public function getThrowsTextAttribute()
    {
        $throws = [
            1 => 'Right',
            2 => 'Left',
        ];
        return $throws[$this->throws] ?? 'Unknown';
    }

    public function getPositionNameAttribute()
    {
        $positions = [
            0 => 'Pinch Hitter',
            1 => 'Pitcher',
            2 => 'Catcher',
            3 => 'First Base',
            4 => 'Second Base',
            5 => 'Third Base',
            6 => 'Shortstop',
            7 => 'Left Field',
            8 => 'Center Field',
            9 => 'Right Field',
            10 => 'Designated Hitter',
        ];
        return  $positions[$this->position] ?? null;
    }
}
