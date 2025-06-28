<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectedStartingPitcher
 * 
 * @property int|null $team_id
 * @property int|null $starter_0
 * @property int|null $starter_1
 * @property int|null $starter_2
 * @property int|null $starter_3
 * @property int|null $starter_4
 * @property int|null $starter_5
 * @property int|null $starter_6
 * @property int|null $starter_7
 *
 * @package App\Models
 */
class ProjectedStartingPitcher extends Model
{
	protected $table = 'projected_starting_pitchers';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'starter_0' => 'int',
		'starter_1' => 'int',
		'starter_2' => 'int',
		'starter_3' => 'int',
		'starter_4' => 'int',
		'starter_5' => 'int',
		'starter_6' => 'int',
		'starter_7' => 'int'
	];

	protected $fillable = [
		'team_id',
		'starter_0',
		'starter_1',
		'starter_2',
		'starter_3',
		'starter_4',
		'starter_5',
		'starter_6',
		'starter_7'
	];
}
