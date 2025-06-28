<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersGameBatting
 * 
 * @property int|null $player_id
 * @property int|null $year
 * @property int|null $team_id
 * @property int|null $game_id
 * @property int|null $league_id
 * @property int|null $level_id
 * @property int|null $split_id
 * @property int|null $position
 * @property int|null $ab
 * @property int|null $h
 * @property int|null $k
 * @property int|null $pa
 * @property int|null $pitches_seen
 * @property int|null $g
 * @property int|null $gs
 * @property int|null $d
 * @property int|null $t
 * @property int|null $hr
 * @property int|null $r
 * @property int|null $rbi
 * @property int|null $sb
 * @property int|null $cs
 * @property int|null $bb
 * @property int|null $ibb
 * @property int|null $gdp
 * @property int|null $sh
 * @property int|null $sf
 * @property int|null $hp
 * @property int|null $ci
 * @property float|null $wpa
 * @property int|null $stint
 * @property float|null $ubr
 *
 * @package App\Models
 */
class PlayersGameBatting extends Model
{
	protected $table = 'players_game_batting';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'year' => 'int',
		'team_id' => 'int',
		'game_id' => 'int',
		'league_id' => 'int',
		'level_id' => 'int',
		'split_id' => 'int',
		'position' => 'int',
		'ab' => 'int',
		'h' => 'int',
		'k' => 'int',
		'pa' => 'int',
		'pitches_seen' => 'int',
		'g' => 'int',
		'gs' => 'int',
		'd' => 'int',
		't' => 'int',
		'hr' => 'int',
		'r' => 'int',
		'rbi' => 'int',
		'sb' => 'int',
		'cs' => 'int',
		'bb' => 'int',
		'ibb' => 'int',
		'gdp' => 'int',
		'sh' => 'int',
		'sf' => 'int',
		'hp' => 'int',
		'ci' => 'int',
		'wpa' => 'float',
		'stint' => 'int',
		'ubr' => 'float'
	];

	protected $fillable = [
		'player_id',
		'year',
		'team_id',
		'game_id',
		'league_id',
		'level_id',
		'split_id',
		'position',
		'ab',
		'h',
		'k',
		'pa',
		'pitches_seen',
		'g',
		'gs',
		'd',
		't',
		'hr',
		'r',
		'rbi',
		'sb',
		'cs',
		'bb',
		'ibb',
		'gdp',
		'sh',
		'sf',
		'hp',
		'ci',
		'wpa',
		'stint',
		'ubr'
	];
}
