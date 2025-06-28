<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LeagueHistory
 * 
 * @property int|null $league_id
 * @property int|null $sub_league_id
 * @property int|null $year
 * @property int|null $best_hitter_id
 * @property int|null $best_pitcher_id
 * @property int|null $best_rookie_id
 * @property int|null $best_manager_id
 * @property int|null $best_fielder_id0
 * @property int|null $best_fielder_id1
 * @property int|null $best_fielder_id2
 * @property int|null $best_fielder_id3
 * @property int|null $best_fielder_id4
 * @property int|null $best_fielder_id5
 * @property int|null $best_fielder_id6
 * @property int|null $best_fielder_id7
 * @property int|null $best_fielder_id8
 * @property int|null $best_fielder_id9
 *
 * @package App\Models
 */
class LeagueHistory extends Model
{
	protected $table = 'league_history';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'league_id' => 'int',
		'sub_league_id' => 'int',
		'year' => 'int',
		'best_hitter_id' => 'int',
		'best_pitcher_id' => 'int',
		'best_rookie_id' => 'int',
		'best_manager_id' => 'int',
		'best_fielder_id0' => 'int',
		'best_fielder_id1' => 'int',
		'best_fielder_id2' => 'int',
		'best_fielder_id3' => 'int',
		'best_fielder_id4' => 'int',
		'best_fielder_id5' => 'int',
		'best_fielder_id6' => 'int',
		'best_fielder_id7' => 'int',
		'best_fielder_id8' => 'int',
		'best_fielder_id9' => 'int'
	];

	protected $fillable = [
		'league_id',
		'sub_league_id',
		'year',
		'best_hitter_id',
		'best_pitcher_id',
		'best_rookie_id',
		'best_manager_id',
		'best_fielder_id0',
		'best_fielder_id1',
		'best_fielder_id2',
		'best_fielder_id3',
		'best_fielder_id4',
		'best_fielder_id5',
		'best_fielder_id6',
		'best_fielder_id7',
		'best_fielder_id8',
		'best_fielder_id9'
	];
}
