<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubLeague
 * 
 * @property int $league_id
 * @property int $sub_league_id
 * @property string|null $name
 * @property string|null $abbr
 * @property int|null $gender
 * @property int|null $designated_hitter
 *
 * @package App\Models
 */
class SubLeague extends Model
{
	protected $table = 'sub_leagues';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'league_id' => 'int',
		'sub_league_id' => 'int',
		'gender' => 'int',
		'designated_hitter' => 'int'
	];

	protected $fillable = [
		'name',
		'abbr',
		'gender',
		'designated_hitter'
	];
}
