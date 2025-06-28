<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamHistory
 * 
 * @property int $team_id
 * @property int $year
 * @property int|null $league_id
 * @property int|null $sub_league_id
 * @property int|null $division_id
 * @property string|null $name
 * @property string|null $abbr
 * @property string|null $nickname
 * @property int|null $best_hitter_id
 * @property int|null $best_pitcher_id
 * @property int|null $best_rookie_id
 * @property int|null $manager_id
 * @property int|null $made_playoffs
 * @property int|null $won_playoffs
 * @property int|null $fired
 * @property int|null $position_in_division
 *
 * @package App\Models
 */
class TeamHistory extends Model
{
	protected $table = 'team_history';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'year' => 'int',
		'league_id' => 'int',
		'sub_league_id' => 'int',
		'division_id' => 'int',
		'best_hitter_id' => 'int',
		'best_pitcher_id' => 'int',
		'best_rookie_id' => 'int',
		'manager_id' => 'int',
		'made_playoffs' => 'int',
		'won_playoffs' => 'int',
		'fired' => 'int',
		'position_in_division' => 'int'
	];

	protected $fillable = [
		'league_id',
		'sub_league_id',
		'division_id',
		'name',
		'abbr',
		'nickname',
		'best_hitter_id',
		'best_pitcher_id',
		'best_rookie_id',
		'manager_id',
		'made_playoffs',
		'won_playoffs',
		'fired',
		'position_in_division'
	];
}
