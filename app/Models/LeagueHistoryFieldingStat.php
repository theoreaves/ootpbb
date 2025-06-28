<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LeagueHistoryFieldingStat
 * 
 * @property int|null $year
 * @property int|null $team_id
 * @property int|null $league_id
 * @property int|null $sub_league_id
 * @property int|null $level_id
 * @property int|null $split_id
 * @property int|null $position
 * @property int|null $g
 * @property int|null $gs
 * @property int|null $tc
 * @property int|null $a
 * @property int|null $po
 * @property int|null $e
 * @property int|null $dp
 * @property int|null $tp
 * @property int|null $pb
 * @property int|null $sba
 * @property int|null $rto
 * @property int|null $er
 * @property int|null $ip
 * @property int|null $ipf
 * @property float|null $pct
 * @property float|null $range
 * @property float|null $rtop
 * @property float|null $cera
 * @property float|null $zr
 * @property int|null $plays
 * @property int|null $plays_base
 * @property int|null $roe
 * @property int|null $eff
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
 *
 * @package App\Models
 */
class LeagueHistoryFieldingStat extends Model
{
	protected $table = 'league_history_fielding_stats';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'year' => 'int',
		'team_id' => 'int',
		'league_id' => 'int',
		'sub_league_id' => 'int',
		'level_id' => 'int',
		'split_id' => 'int',
		'position' => 'int',
		'g' => 'int',
		'gs' => 'int',
		'tc' => 'int',
		'a' => 'int',
		'po' => 'int',
		'e' => 'int',
		'dp' => 'int',
		'tp' => 'int',
		'pb' => 'int',
		'sba' => 'int',
		'rto' => 'int',
		'er' => 'int',
		'ip' => 'int',
		'ipf' => 'int',
		'pct' => 'float',
		'range' => 'float',
		'rtop' => 'float',
		'cera' => 'float',
		'zr' => 'float',
		'plays' => 'int',
		'plays_base' => 'int',
		'roe' => 'int',
		'eff' => 'int',
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
		'arm' => 'float'
	];

	protected $fillable = [
		'year',
		'team_id',
		'league_id',
		'sub_league_id',
		'level_id',
		'split_id',
		'position',
		'g',
		'gs',
		'tc',
		'a',
		'po',
		'e',
		'dp',
		'tp',
		'pb',
		'sba',
		'rto',
		'er',
		'ip',
		'ipf',
		'pct',
		'range',
		'rtop',
		'cera',
		'zr',
		'plays',
		'plays_base',
		'roe',
		'eff',
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
		'arm'
	];
}
