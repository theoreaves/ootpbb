<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LeagueHistoryBattingStat
 * 
 * @property int|null $year
 * @property int|null $team_id
 * @property int|null $game_id
 * @property int|null $league_id
 * @property int|null $level_id
 * @property int|null $split_id
 * @property int|null $pa
 * @property int|null $ab
 * @property int|null $h
 * @property int|null $k
 * @property int|null $tb
 * @property int|null $s
 * @property int|null $d
 * @property int|null $t
 * @property int|null $hr
 * @property int|null $sb
 * @property int|null $cs
 * @property int|null $rbi
 * @property int|null $r
 * @property int|null $bb
 * @property int|null $ibb
 * @property int|null $hp
 * @property int|null $sh
 * @property int|null $sf
 * @property int|null $ci
 * @property int|null $gdp
 * @property int|null $g
 * @property int|null $gs
 * @property int|null $ebh
 * @property int|null $pitches_seen
 * @property float|null $avg
 * @property float|null $obp
 * @property float|null $slg
 * @property float|null $rc
 * @property float|null $rc27
 * @property float|null $iso
 * @property float|null $woba
 * @property float|null $ops
 * @property float|null $sbp
 * @property float|null $kp
 * @property float|null $bbp
 * @property float|null $wpa
 * @property float|null $babip
 *
 * @package App\Models
 */
class LeagueHistoryBattingStat extends Model
{
	protected $table = 'league_history_batting_stats';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'year' => 'int',
		'team_id' => 'int',
		'game_id' => 'int',
		'league_id' => 'int',
		'level_id' => 'int',
		'split_id' => 'int',
		'pa' => 'int',
		'ab' => 'int',
		'h' => 'int',
		'k' => 'int',
		'tb' => 'int',
		's' => 'int',
		'd' => 'int',
		't' => 'int',
		'hr' => 'int',
		'sb' => 'int',
		'cs' => 'int',
		'rbi' => 'int',
		'r' => 'int',
		'bb' => 'int',
		'ibb' => 'int',
		'hp' => 'int',
		'sh' => 'int',
		'sf' => 'int',
		'ci' => 'int',
		'gdp' => 'int',
		'g' => 'int',
		'gs' => 'int',
		'ebh' => 'int',
		'pitches_seen' => 'int',
		'avg' => 'float',
		'obp' => 'float',
		'slg' => 'float',
		'rc' => 'float',
		'rc27' => 'float',
		'iso' => 'float',
		'woba' => 'float',
		'ops' => 'float',
		'sbp' => 'float',
		'kp' => 'float',
		'bbp' => 'float',
		'wpa' => 'float',
		'babip' => 'float'
	];

	protected $fillable = [
		'year',
		'team_id',
		'game_id',
		'league_id',
		'level_id',
		'split_id',
		'pa',
		'ab',
		'h',
		'k',
		'tb',
		's',
		'd',
		't',
		'hr',
		'sb',
		'cs',
		'rbi',
		'r',
		'bb',
		'ibb',
		'hp',
		'sh',
		'sf',
		'ci',
		'gdp',
		'g',
		'gs',
		'ebh',
		'pitches_seen',
		'avg',
		'obp',
		'slg',
		'rc',
		'rc27',
		'iso',
		'woba',
		'ops',
		'sbp',
		'kp',
		'bbp',
		'wpa',
		'babip'
	];
}
