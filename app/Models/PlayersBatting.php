<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersBatting
 * 
 * @property int|null $player_id
 * @property int|null $team_id
 * @property int|null $league_id
 * @property int|null $position
 * @property int|null $role
 * @property int|null $bats
 * @property int|null $batting_ratings_overall_contact
 * @property int|null $batting_ratings_overall_gap
 * @property int|null $batting_ratings_overall_eye
 * @property int|null $batting_ratings_overall_strikeouts
 * @property int|null $batting_ratings_overall_hp
 * @property int|null $batting_ratings_overall_power
 * @property int|null $batting_ratings_overall_babip
 * @property int|null $batting_ratings_vsr_contact
 * @property int|null $batting_ratings_vsr_gap
 * @property int|null $batting_ratings_vsr_eye
 * @property int|null $batting_ratings_vsr_strikeouts
 * @property int|null $batting_ratings_vsr_hp
 * @property int|null $batting_ratings_vsr_power
 * @property int|null $batting_ratings_vsr_babip
 * @property int|null $batting_ratings_vsl_contact
 * @property int|null $batting_ratings_vsl_gap
 * @property int|null $batting_ratings_vsl_eye
 * @property int|null $batting_ratings_vsl_strikeouts
 * @property int|null $batting_ratings_vsl_hp
 * @property int|null $batting_ratings_vsl_power
 * @property int|null $batting_ratings_vsl_babip
 * @property int|null $batting_ratings_talent_contact
 * @property int|null $batting_ratings_talent_gap
 * @property int|null $batting_ratings_talent_eye
 * @property int|null $batting_ratings_talent_strikeouts
 * @property int|null $batting_ratings_talent_hp
 * @property int|null $batting_ratings_talent_power
 * @property int|null $batting_ratings_talent_babip
 * @property int|null $batting_ratings_misc_bunt
 * @property int|null $batting_ratings_misc_bunt_for_hit
 * @property int|null $batting_ratings_misc_gb_hitter_type
 * @property int|null $batting_ratings_misc_fb_hitter_type
 * @property int|null $running_ratings_speed
 * @property int|null $running_ratings_stealing_rate
 * @property int|null $running_ratings_stealing
 * @property int|null $running_ratings_baserunning
 *
 * @package App\Models
 */
class PlayersBatting extends Model
{
	protected $table = 'players_batting';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'team_id' => 'int',
		'league_id' => 'int',
		'position' => 'int',
		'role' => 'int',
		'bats' => 'int',
		'batting_ratings_overall_contact' => 'int',
		'batting_ratings_overall_gap' => 'int',
		'batting_ratings_overall_eye' => 'int',
		'batting_ratings_overall_strikeouts' => 'int',
		'batting_ratings_overall_hp' => 'int',
		'batting_ratings_overall_power' => 'int',
		'batting_ratings_overall_babip' => 'int',
		'batting_ratings_vsr_contact' => 'int',
		'batting_ratings_vsr_gap' => 'int',
		'batting_ratings_vsr_eye' => 'int',
		'batting_ratings_vsr_strikeouts' => 'int',
		'batting_ratings_vsr_hp' => 'int',
		'batting_ratings_vsr_power' => 'int',
		'batting_ratings_vsr_babip' => 'int',
		'batting_ratings_vsl_contact' => 'int',
		'batting_ratings_vsl_gap' => 'int',
		'batting_ratings_vsl_eye' => 'int',
		'batting_ratings_vsl_strikeouts' => 'int',
		'batting_ratings_vsl_hp' => 'int',
		'batting_ratings_vsl_power' => 'int',
		'batting_ratings_vsl_babip' => 'int',
		'batting_ratings_talent_contact' => 'int',
		'batting_ratings_talent_gap' => 'int',
		'batting_ratings_talent_eye' => 'int',
		'batting_ratings_talent_strikeouts' => 'int',
		'batting_ratings_talent_hp' => 'int',
		'batting_ratings_talent_power' => 'int',
		'batting_ratings_talent_babip' => 'int',
		'batting_ratings_misc_bunt' => 'int',
		'batting_ratings_misc_bunt_for_hit' => 'int',
		'batting_ratings_misc_gb_hitter_type' => 'int',
		'batting_ratings_misc_fb_hitter_type' => 'int',
		'running_ratings_speed' => 'int',
		'running_ratings_stealing_rate' => 'int',
		'running_ratings_stealing' => 'int',
		'running_ratings_baserunning' => 'int'
	];

	protected $fillable = [
		'player_id',
		'team_id',
		'league_id',
		'position',
		'role',
		'bats',
		'batting_ratings_overall_contact',
		'batting_ratings_overall_gap',
		'batting_ratings_overall_eye',
		'batting_ratings_overall_strikeouts',
		'batting_ratings_overall_hp',
		'batting_ratings_overall_power',
		'batting_ratings_overall_babip',
		'batting_ratings_vsr_contact',
		'batting_ratings_vsr_gap',
		'batting_ratings_vsr_eye',
		'batting_ratings_vsr_strikeouts',
		'batting_ratings_vsr_hp',
		'batting_ratings_vsr_power',
		'batting_ratings_vsr_babip',
		'batting_ratings_vsl_contact',
		'batting_ratings_vsl_gap',
		'batting_ratings_vsl_eye',
		'batting_ratings_vsl_strikeouts',
		'batting_ratings_vsl_hp',
		'batting_ratings_vsl_power',
		'batting_ratings_vsl_babip',
		'batting_ratings_talent_contact',
		'batting_ratings_talent_gap',
		'batting_ratings_talent_eye',
		'batting_ratings_talent_strikeouts',
		'batting_ratings_talent_hp',
		'batting_ratings_talent_power',
		'batting_ratings_talent_babip',
		'batting_ratings_misc_bunt',
		'batting_ratings_misc_bunt_for_hit',
		'batting_ratings_misc_gb_hitter_type',
		'batting_ratings_misc_fb_hitter_type',
		'running_ratings_speed',
		'running_ratings_stealing_rate',
		'running_ratings_stealing',
		'running_ratings_baserunning'
	];
}
