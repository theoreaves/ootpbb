<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamFieldingStatsStat
 * 
 * @property int $team_id
 * @property int|null $year
 * @property int|null $league_id
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
 *
 * @package App\Models
 */
class TeamFieldingStatsStat extends Model
{
	protected $table = 'team_fielding_stats_stats';
	protected $primaryKey = 'team_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'year' => 'int',
		'league_id' => 'int',
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
		'cera' => 'float'
	];

	protected $fillable = [
		'year',
		'league_id',
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
		'cera'
	];
}
