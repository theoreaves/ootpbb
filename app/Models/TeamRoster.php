<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamRoster
 * 
 * @property int $team_id
 * @property int $player_id
 * @property int $list_id
 *
 * @package App\Models
 */
class TeamRoster extends Model
{
	protected $table = 'team_roster';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'player_id' => 'int',
		'list_id' => 'int'
	];
}
