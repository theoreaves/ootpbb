<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersFielding
 * 
 * @property int|null $player_id
 * @property int|null $team_id
 * @property int|null $league_id
 * @property int|null $position
 * @property int|null $role
 * @property int|null $fielding_ratings_infield_range
 * @property int|null $fielding_ratings_infield_arm
 * @property int|null $fielding_ratings_turn_doubleplay
 * @property int|null $fielding_ratings_outfield_range
 * @property int|null $fielding_ratings_outfield_arm
 * @property int|null $fielding_ratings_catcher_arm
 * @property int|null $fielding_ratings_catcher_ability
 * @property int|null $fielding_ratings_catcher_framing
 * @property int|null $fielding_ratings_infield_error
 * @property int|null $fielding_ratings_outfield_error
 * @property int|null $fielding_experience0
 * @property int|null $fielding_experience1
 * @property int|null $fielding_experience2
 * @property int|null $fielding_experience3
 * @property int|null $fielding_experience4
 * @property int|null $fielding_experience5
 * @property int|null $fielding_experience6
 * @property int|null $fielding_experience7
 * @property int|null $fielding_experience8
 * @property int|null $fielding_experience9
 * @property int|null $fielding_rating_pos1
 * @property int|null $fielding_rating_pos2
 * @property int|null $fielding_rating_pos3
 * @property int|null $fielding_rating_pos4
 * @property int|null $fielding_rating_pos5
 * @property int|null $fielding_rating_pos6
 * @property int|null $fielding_rating_pos7
 * @property int|null $fielding_rating_pos8
 * @property int|null $fielding_rating_pos9
 * @property int|null $fielding_rating_pos1_pot
 * @property int|null $fielding_rating_pos2_pot
 * @property int|null $fielding_rating_pos3_pot
 * @property int|null $fielding_rating_pos4_pot
 * @property int|null $fielding_rating_pos5_pot
 * @property int|null $fielding_rating_pos6_pot
 * @property int|null $fielding_rating_pos7_pot
 * @property int|null $fielding_rating_pos8_pot
 * @property int|null $fielding_rating_pos9_pot
 *
 * @package App\Models
 */
class PlayersFielding extends Model
{
	protected $table = 'players_fielding';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'team_id' => 'int',
		'league_id' => 'int',
		'position' => 'int',
		'role' => 'int',
		'fielding_ratings_infield_range' => 'int',
		'fielding_ratings_infield_arm' => 'int',
		'fielding_ratings_turn_doubleplay' => 'int',
		'fielding_ratings_outfield_range' => 'int',
		'fielding_ratings_outfield_arm' => 'int',
		'fielding_ratings_catcher_arm' => 'int',
		'fielding_ratings_catcher_ability' => 'int',
		'fielding_ratings_catcher_framing' => 'int',
		'fielding_ratings_infield_error' => 'int',
		'fielding_ratings_outfield_error' => 'int',
		'fielding_experience0' => 'int',
		'fielding_experience1' => 'int',
		'fielding_experience2' => 'int',
		'fielding_experience3' => 'int',
		'fielding_experience4' => 'int',
		'fielding_experience5' => 'int',
		'fielding_experience6' => 'int',
		'fielding_experience7' => 'int',
		'fielding_experience8' => 'int',
		'fielding_experience9' => 'int',
		'fielding_rating_pos1' => 'int',
		'fielding_rating_pos2' => 'int',
		'fielding_rating_pos3' => 'int',
		'fielding_rating_pos4' => 'int',
		'fielding_rating_pos5' => 'int',
		'fielding_rating_pos6' => 'int',
		'fielding_rating_pos7' => 'int',
		'fielding_rating_pos8' => 'int',
		'fielding_rating_pos9' => 'int',
		'fielding_rating_pos1_pot' => 'int',
		'fielding_rating_pos2_pot' => 'int',
		'fielding_rating_pos3_pot' => 'int',
		'fielding_rating_pos4_pot' => 'int',
		'fielding_rating_pos5_pot' => 'int',
		'fielding_rating_pos6_pot' => 'int',
		'fielding_rating_pos7_pot' => 'int',
		'fielding_rating_pos8_pot' => 'int',
		'fielding_rating_pos9_pot' => 'int'
	];

	protected $fillable = [
		'player_id',
		'team_id',
		'league_id',
		'position',
		'role',
		'fielding_ratings_infield_range',
		'fielding_ratings_infield_arm',
		'fielding_ratings_turn_doubleplay',
		'fielding_ratings_outfield_range',
		'fielding_ratings_outfield_arm',
		'fielding_ratings_catcher_arm',
		'fielding_ratings_catcher_ability',
		'fielding_ratings_catcher_framing',
		'fielding_ratings_infield_error',
		'fielding_ratings_outfield_error',
		'fielding_experience0',
		'fielding_experience1',
		'fielding_experience2',
		'fielding_experience3',
		'fielding_experience4',
		'fielding_experience5',
		'fielding_experience6',
		'fielding_experience7',
		'fielding_experience8',
		'fielding_experience9',
		'fielding_rating_pos1',
		'fielding_rating_pos2',
		'fielding_rating_pos3',
		'fielding_rating_pos4',
		'fielding_rating_pos5',
		'fielding_rating_pos6',
		'fielding_rating_pos7',
		'fielding_rating_pos8',
		'fielding_rating_pos9',
		'fielding_rating_pos1_pot',
		'fielding_rating_pos2_pot',
		'fielding_rating_pos3_pot',
		'fielding_rating_pos4_pot',
		'fielding_rating_pos5_pot',
		'fielding_rating_pos6_pot',
		'fielding_rating_pos7_pot',
		'fielding_rating_pos8_pot',
		'fielding_rating_pos9_pot'
	];
}
