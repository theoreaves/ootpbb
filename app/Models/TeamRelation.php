<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamRelation
 * 
 * @property int $league_id
 * @property int $sub_league_id
 * @property int $division_id
 * @property int $team_id
 *
 * @package App\Models
 */
class TeamRelation extends Model
{
	protected $table = 'team_relations';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'league_id' => 'int',
		'sub_league_id' => 'int',
		'division_id' => 'int',
		'team_id' => 'int'
	];
}
