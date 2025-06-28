<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersLeagueLeader
 * 
 * @property int|null $player_id
 * @property int|null $league_id
 * @property int|null $sub_league_id
 * @property int|null $year
 * @property int|null $category
 * @property int|null $place
 * @property float|null $amount
 *
 * @package App\Models
 */
class PlayersLeagueLeader extends Model
{
	protected $table = 'players_league_leader';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'league_id' => 'int',
		'sub_league_id' => 'int',
		'year' => 'int',
		'category' => 'int',
		'place' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'player_id',
		'league_id',
		'sub_league_id',
		'year',
		'category',
		'place',
		'amount'
	];
}
