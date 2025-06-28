<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LeagueHistoryAllStar
 * 
 * @property int|null $league_id
 * @property int|null $sub_league_id
 * @property int|null $year
 * @property int|null $all_star_pos
 * @property int|null $all_star
 *
 * @package App\Models
 */
class LeagueHistoryAllStar extends Model
{
	protected $table = 'league_history_all_star';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'league_id' => 'int',
		'sub_league_id' => 'int',
		'year' => 'int',
		'all_star_pos' => 'int',
		'all_star' => 'int'
	];

	protected $fillable = [
		'league_id',
		'sub_league_id',
		'year',
		'all_star_pos',
		'all_star'
	];
}
