<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersValue
 * 
 * @property int|null $player_id
 * @property int|null $team_id
 * @property int|null $league_id
 * @property int|null $position
 * @property int|null $role
 * @property int|null $offensive_value
 * @property int|null $offensive_value_talent
 * @property int|null $offensive_value_vsl
 * @property int|null $offensive_value_vsr
 * @property int|null $pitching_value
 * @property int|null $pitching_value_talent
 * @property int|null $pitching_value_vsl
 * @property int|null $pitching_value_vsr
 * @property int|null $overall_value
 * @property int|null $talent_value
 * @property int|null $career_value
 * @property int|null $leadoff_value_vsl
 * @property int|null $leadoff_value_vsr
 * @property int|null $running_value
 * @property int|null $stealing_value
 * @property float|null $season_performance
 * @property int|null $stats_value_0
 * @property int|null $stats_value_1
 * @property int|null $stats_value_2
 * @property int|null $stats_mod_0
 * @property int|null $stats_mod_1
 * @property int|null $stats_mod_2
 * @property int|null $ratings_value
 * @property int|null $overall_sp
 * @property int|null $overall_rp
 * @property int|null $overall_c
 * @property int|null $overall_1b
 * @property int|null $overall_2b
 * @property int|null $overall_3b
 * @property int|null $overall_ss
 * @property int|null $overall_lf
 * @property int|null $overall_cf
 * @property int|null $overall_rf
 * @property float|null $award_bat
 * @property float|null $award_pit
 * @property float|null $award_field
 * @property int|null $oa
 * @property int|null $pot
 * @property int|null $oa_rating
 * @property int|null $pot_rating
 *
 * @package App\Models
 */
class PlayersValue extends Model
{
	protected $table = 'players_value';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'team_id' => 'int',
		'league_id' => 'int',
		'position' => 'int',
		'role' => 'int',
		'offensive_value' => 'int',
		'offensive_value_talent' => 'int',
		'offensive_value_vsl' => 'int',
		'offensive_value_vsr' => 'int',
		'pitching_value' => 'int',
		'pitching_value_talent' => 'int',
		'pitching_value_vsl' => 'int',
		'pitching_value_vsr' => 'int',
		'overall_value' => 'int',
		'talent_value' => 'int',
		'career_value' => 'int',
		'leadoff_value_vsl' => 'int',
		'leadoff_value_vsr' => 'int',
		'running_value' => 'int',
		'stealing_value' => 'int',
		'season_performance' => 'float',
		'stats_value_0' => 'int',
		'stats_value_1' => 'int',
		'stats_value_2' => 'int',
		'stats_mod_0' => 'int',
		'stats_mod_1' => 'int',
		'stats_mod_2' => 'int',
		'ratings_value' => 'int',
		'overall_sp' => 'int',
		'overall_rp' => 'int',
		'overall_c' => 'int',
		'overall_1b' => 'int',
		'overall_2b' => 'int',
		'overall_3b' => 'int',
		'overall_ss' => 'int',
		'overall_lf' => 'int',
		'overall_cf' => 'int',
		'overall_rf' => 'int',
		'award_bat' => 'float',
		'award_pit' => 'float',
		'award_field' => 'float',
		'oa' => 'int',
		'pot' => 'int',
		'oa_rating' => 'int',
		'pot_rating' => 'int'
	];

	protected $fillable = [
		'player_id',
		'team_id',
		'league_id',
		'position',
		'role',
		'offensive_value',
		'offensive_value_talent',
		'offensive_value_vsl',
		'offensive_value_vsr',
		'pitching_value',
		'pitching_value_talent',
		'pitching_value_vsl',
		'pitching_value_vsr',
		'overall_value',
		'talent_value',
		'career_value',
		'leadoff_value_vsl',
		'leadoff_value_vsr',
		'running_value',
		'stealing_value',
		'season_performance',
		'stats_value_0',
		'stats_value_1',
		'stats_value_2',
		'stats_mod_0',
		'stats_mod_1',
		'stats_mod_2',
		'ratings_value',
		'overall_sp',
		'overall_rp',
		'overall_c',
		'overall_1b',
		'overall_2b',
		'overall_3b',
		'overall_ss',
		'overall_lf',
		'overall_cf',
		'overall_rf',
		'award_bat',
		'award_pit',
		'award_field',
		'oa',
		'pot',
		'oa_rating',
		'pot_rating'
	];
}
