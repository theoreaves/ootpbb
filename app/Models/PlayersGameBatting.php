<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersGameBatting
 *
 * @property int|null $player_id
 * @property int|null $year
 * @property int|null $team_id
 * @property int|null $game_id
 * @property int|null $league_id
 * @property int|null $level_id
 * @property int|null $split_id
 * @property int|null $position
 * @property int|null $ab
 * @property int|null $h
 * @property int|null $k
 * @property int|null $pa
 * @property int|null $pitches_seen
 * @property int|null $g
 * @property int|null $gs
 * @property int|null $d
 * @property int|null $t
 * @property int|null $hr
 * @property int|null $r
 * @property int|null $rbi
 * @property int|null $sb
 * @property int|null $cs
 * @property int|null $bb
 * @property int|null $ibb
 * @property int|null $gdp
 * @property int|null $sh
 * @property int|null $sf
 * @property int|null $hp
 * @property int|null $ci
 * @property float|null $wpa
 * @property int|null $stint
 * @property float|null $ubr
 *
 * @package App\Models
 */
class PlayersGameBatting extends Model
{
	protected $table = 'players_game_batting';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'year' => 'int',
		'team_id' => 'int',
		'game_id' => 'int',
		'league_id' => 'int',
		'level_id' => 'int',
		'split_id' => 'int',
		'position' => 'int',
		'ab' => 'int',
		'h' => 'int',
		'k' => 'int',
		'pa' => 'int',
		'pitches_seen' => 'int',
		'g' => 'int',
		'gs' => 'int',
		'd' => 'int',
		't' => 'int',
		'hr' => 'int',
		'r' => 'int',
		'rbi' => 'int',
		'sb' => 'int',
		'cs' => 'int',
		'bb' => 'int',
		'ibb' => 'int',
		'gdp' => 'int',
		'sh' => 'int',
		'sf' => 'int',
		'hp' => 'int',
		'ci' => 'int',
		'wpa' => 'float',
		'stint' => 'int',
		'ubr' => 'float'
	];

	protected $fillable = [
		'player_id',
		'year',
		'team_id',
		'game_id',
		'league_id',
		'level_id',
		'split_id',
		'position',
		'ab',
		'h',
		'k',
		'pa',
		'pitches_seen',
		'g',
		'gs',
		'd',
		't',
		'hr',
		'r',
		'rbi',
		'sb',
		'cs',
		'bb',
		'ibb',
		'gdp',
		'sh',
		'sf',
		'hp',
		'ci',
		'wpa',
		'stint',
		'ubr'
	];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function league()
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function getPositionNameAttribute()
    {
        $positions = [
            0 => 'PH',
            1 => 'P',
            2 => 'C',
            3 => '1B',
            4 => '2B',
            5 => '3B',
            6 => 'SS',
            7 => 'LF',
            8 => 'CF',
            9 => 'RF',
            10 => 'DH',
        ];
        return  $positions[$this->position] ?? null;
    }

    public function getPostGameAverageAttribute()
    {
        if (! $this->player_id || ! $this->year || ! $this->game || ! $this->game->date) {
            return null;
        }

        $gameDate = \Carbon\Carbon::parse($this->game->date)->toDateString();

        $prior = self::where('player_id', $this->player_id)
            ->where('year', $this->year)
//            ->where('split_id', $this->split_id)
            ->whereHas('game', function ($query) use ($gameDate) {
                $query->where('game_type', 0);
                $query->whereDate('date', '<', $gameDate);
            })
            ->selectRaw('SUM(ab) as ab, SUM(h) as h')
            ->first();

        $preAb = $prior->ab ?? 0;
        $preH  = $prior->h ?? 0;

        $totalAb = $preAb + $this->ab;
        $totalH  = $preH + $this->h;

        return $totalAb > 0 ? round($totalH / $totalAb, 3) : null;
    }




}
