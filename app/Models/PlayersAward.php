<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersAward
 * 
 * @property int|null $player_id
 * @property int|null $league_id
 * @property int|null $team_id
 * @property int|null $sub_league_id
 * @property int|null $award_id
 * @property int|null $year
 * @property int|null $season
 * @property int|null $position
 * @property int|null $day
 * @property int|null $month
 * @property int|null $finish
 *
 * @package App\Models
 */
class PlayersAward extends Model
{
	protected $table = 'players_awards';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'league_id' => 'int',
		'team_id' => 'int',
		'sub_league_id' => 'int',
		'award_id' => 'int',
		'year' => 'int',
		'season' => 'int',
		'position' => 'int',
		'day' => 'int',
		'month' => 'int',
		'finish' => 'int'
	];

	protected $fillable = [
		'player_id',
		'league_id',
		'team_id',
		'sub_league_id',
		'award_id',
		'year',
		'season',
		'position',
		'day',
		'month',
		'finish'
	];
}
