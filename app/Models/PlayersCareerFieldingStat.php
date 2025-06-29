<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersCareerFieldingStat
 *
 * @property int|null $player_id
 * @property int|null $year
 * @property int|null $team_id
 * @property int|null $league_id
 * @property int|null $level_id
 * @property int|null $split_id
 * @property int|null $position
 * @property int|null $tc
 * @property int|null $a
 * @property int|null $po
 * @property int|null $er
 * @property int|null $ip
 * @property int|null $g
 * @property int|null $gs
 * @property int|null $e
 * @property int|null $dp
 * @property int|null $tp
 * @property int|null $pb
 * @property int|null $sba
 * @property int|null $rto
 * @property int|null $ipf
 * @property int|null $plays
 * @property int|null $plays_base
 * @property int|null $roe
 * @property int|null $opps_0
 * @property int|null $opps_made_0
 * @property int|null $opps_1
 * @property int|null $opps_made_1
 * @property int|null $opps_2
 * @property int|null $opps_made_2
 * @property int|null $opps_3
 * @property int|null $opps_made_3
 * @property int|null $opps_4
 * @property int|null $opps_made_4
 * @property int|null $opps_5
 * @property int|null $opps_made_5
 * @property float|null $framing
 * @property float|null $arm
 * @property float|null $zr
 *
 * @package App\Models
 */
class PlayersCareerFieldingStat extends Model
{
	protected $table = 'players_career_fielding_stats';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'year' => 'int',
		'team_id' => 'int',
		'league_id' => 'int',
		'level_id' => 'int',
		'split_id' => 'int',
		'position' => 'int',
		'tc' => 'int',
		'a' => 'int',
		'po' => 'int',
		'er' => 'int',
		'ip' => 'int',
		'g' => 'int',
		'gs' => 'int',
		'e' => 'int',
		'dp' => 'int',
		'tp' => 'int',
		'pb' => 'int',
		'sba' => 'int',
		'rto' => 'int',
		'ipf' => 'int',
		'plays' => 'int',
		'plays_base' => 'int',
		'roe' => 'int',
		'opps_0' => 'int',
		'opps_made_0' => 'int',
		'opps_1' => 'int',
		'opps_made_1' => 'int',
		'opps_2' => 'int',
		'opps_made_2' => 'int',
		'opps_3' => 'int',
		'opps_made_3' => 'int',
		'opps_4' => 'int',
		'opps_made_4' => 'int',
		'opps_5' => 'int',
		'opps_made_5' => 'int',
		'framing' => 'float',
		'arm' => 'float',
		'zr' => 'float'
	];

	protected $fillable = [
		'player_id',
		'year',
		'team_id',
		'league_id',
		'level_id',
		'split_id',
		'position',
		'tc',
		'a',
		'po',
		'er',
		'ip',
		'g',
		'gs',
		'e',
		'dp',
		'tp',
		'pb',
		'sba',
		'rto',
		'ipf',
		'plays',
		'plays_base',
		'roe',
		'opps_0',
		'opps_made_0',
		'opps_1',
		'opps_made_1',
		'opps_2',
		'opps_made_2',
		'opps_3',
		'opps_made_3',
		'opps_4',
		'opps_made_4',
		'opps_5',
		'opps_made_5',
		'framing',
		'arm',
		'zr'
	];
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function league()
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
