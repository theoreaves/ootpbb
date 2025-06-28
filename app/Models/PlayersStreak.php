<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersStreak
 * 
 * @property int|null $player_id
 * @property int|null $league_id
 * @property int|null $streak_id
 * @property int|null $value
 * @property int|null $has_ended
 * @property Carbon|null $started
 * @property Carbon|null $ended
 *
 * @package App\Models
 */
class PlayersStreak extends Model
{
	protected $table = 'players_streak';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'league_id' => 'int',
		'streak_id' => 'int',
		'value' => 'int',
		'has_ended' => 'int',
		'started' => 'datetime',
		'ended' => 'datetime'
	];

	protected $fillable = [
		'player_id',
		'league_id',
		'streak_id',
		'value',
		'has_ended',
		'started',
		'ended'
	];
}
