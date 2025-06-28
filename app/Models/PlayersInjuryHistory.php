<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersInjuryHistory
 * 
 * @property int|null $player_id
 * @property Carbon|null $date
 * @property int|null $length
 * @property int|null $setbacks
 * @property int|null $day_to_day
 * @property int|null $effect
 * @property int|null $body_part
 *
 * @package App\Models
 */
class PlayersInjuryHistory extends Model
{
	protected $table = 'players_injury_history';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'date' => 'datetime',
		'length' => 'int',
		'setbacks' => 'int',
		'day_to_day' => 'int',
		'effect' => 'int',
		'body_part' => 'int'
	];

	protected $fillable = [
		'player_id',
		'date',
		'length',
		'setbacks',
		'day_to_day',
		'effect',
		'body_part'
	];
}
