<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersSalaryHistory
 * 
 * @property int|null $player_id
 * @property int|null $team_id
 * @property int|null $year
 * @property int|null $salary
 * @property int|null $uniform
 *
 * @package App\Models
 */
class PlayersSalaryHistory extends Model
{
	protected $table = 'players_salary_history';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'team_id' => 'int',
		'year' => 'int',
		'salary' => 'int',
		'uniform' => 'int'
	];

	protected $fillable = [
		'player_id',
		'team_id',
		'year',
		'salary',
		'uniform'
	];
}
