<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamAffiliation
 * 
 * @property int $team_id
 * @property int $affiliated_team_id
 *
 * @package App\Models
 */
class TeamAffiliation extends Model
{
	protected $table = 'team_affiliations';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'affiliated_team_id' => 'int'
	];
}
