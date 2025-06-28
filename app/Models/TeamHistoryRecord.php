<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamHistoryRecord
 * 
 * @property int $team_id
 * @property int $year
 * @property int|null $league_id
 * @property int|null $sub_league_id
 * @property int|null $division_id
 * @property int|null $g
 * @property int|null $w
 * @property int|null $l
 * @property int|null $t
 * @property int|null $pos
 * @property float|null $pct
 * @property float|null $gb
 * @property int|null $streak
 * @property int|null $magic_number
 *
 * @package App\Models
 */
class TeamHistoryRecord extends Model
{
	protected $table = 'team_history_record';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'year' => 'int',
		'league_id' => 'int',
		'sub_league_id' => 'int',
		'division_id' => 'int',
		'g' => 'int',
		'w' => 'int',
		'l' => 'int',
		't' => 'int',
		'pos' => 'int',
		'pct' => 'float',
		'gb' => 'float',
		'streak' => 'int',
		'magic_number' => 'int'
	];

	protected $fillable = [
		'league_id',
		'sub_league_id',
		'division_id',
		'g',
		'w',
		'l',
		't',
		'pos',
		'pct',
		'gb',
		'streak',
		'magic_number'
	];
}
