<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersAtBatBattingStat
 * 
 * @property int|null $player_id
 * @property int|null $game_id
 * @property int|null $opponent_player_id
 * @property int|null $team_id
 * @property int|null $sac
 * @property int|null $balls
 * @property int|null $strikes
 * @property int|null $result
 * @property int|null $base1
 * @property int|null $base2
 * @property int|null $base3
 * @property int|null $Close
 * @property int|null $pinch
 * @property int|null $inning
 * @property int|null $run_diff
 * @property int|null $outs
 * @property int|null $sb
 * @property int|null $cs
 * @property int|null $rbi
 * @property int|null $r
 * @property int|null $spot
 * @property int|null $hit_loc
 * @property int|null $hit_xy
 * @property int|null $exit_velo
 * @property int|null $launch_angle
 *
 * @package App\Models
 */
class PlayersAtBatBattingStat extends Model
{
	protected $table = 'players_at_bat_batting_stats';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'game_id' => 'int',
		'opponent_player_id' => 'int',
		'team_id' => 'int',
		'sac' => 'int',
		'balls' => 'int',
		'strikes' => 'int',
		'result' => 'int',
		'base1' => 'int',
		'base2' => 'int',
		'base3' => 'int',
		'Close' => 'int',
		'pinch' => 'int',
		'inning' => 'int',
		'run_diff' => 'int',
		'outs' => 'int',
		'sb' => 'int',
		'cs' => 'int',
		'rbi' => 'int',
		'r' => 'int',
		'spot' => 'int',
		'hit_loc' => 'int',
		'hit_xy' => 'int',
		'exit_velo' => 'int',
		'launch_angle' => 'int'
	];

	protected $fillable = [
		'player_id',
		'game_id',
		'opponent_player_id',
		'team_id',
		'sac',
		'balls',
		'strikes',
		'result',
		'base1',
		'base2',
		'base3',
		'Close',
		'pinch',
		'inning',
		'run_diff',
		'outs',
		'sb',
		'cs',
		'rbi',
		'r',
		'spot',
		'hit_loc',
		'hit_xy',
		'exit_velo',
		'launch_angle'
	];
}
