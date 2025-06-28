<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersIndividualBattingStat
 * 
 * @property int|null $player_id
 * @property int|null $opponent_id
 * @property int|null $ab
 * @property int|null $h
 * @property int|null $hr
 *
 * @package App\Models
 */
class PlayersIndividualBattingStat extends Model
{
	protected $table = 'players_individual_batting_stats';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'opponent_id' => 'int',
		'ab' => 'int',
		'h' => 'int',
		'hr' => 'int'
	];

	protected $fillable = [
		'player_id',
		'opponent_id',
		'ab',
		'h',
		'hr'
	];
}
