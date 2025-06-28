<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersPitching
 * 
 * @property int|null $player_id
 * @property int|null $team_id
 * @property int|null $league_id
 * @property int|null $position
 * @property int|null $role
 * @property int|null $pitching_ratings_overall_stuff
 * @property int|null $pitching_ratings_overall_movement
 * @property int|null $pitching_ratings_overall_hra
 * @property int|null $pitching_ratings_overall_pbabip
 * @property int|null $pitching_ratings_overall_control
 * @property int|null $pitching_ratings_overall_balk
 * @property int|null $pitching_ratings_overall_hp
 * @property int|null $pitching_ratings_overall_wild_pitch
 * @property int|null $pitching_ratings_vsr_stuff
 * @property int|null $pitching_ratings_vsr_movement
 * @property int|null $pitching_ratings_vsr_hra
 * @property int|null $pitching_ratings_vsr_pbabip
 * @property int|null $pitching_ratings_vsr_control
 * @property int|null $pitching_ratings_vsr_balk
 * @property int|null $pitching_ratings_vsr_hp
 * @property int|null $pitching_ratings_vsr_wild_pitch
 * @property int|null $pitching_ratings_vsl_stuff
 * @property int|null $pitching_ratings_vsl_movement
 * @property int|null $pitching_ratings_vsl_hra
 * @property int|null $pitching_ratings_vsl_pbabip
 * @property int|null $pitching_ratings_vsl_control
 * @property int|null $pitching_ratings_vsl_balk
 * @property int|null $pitching_ratings_vsl_hp
 * @property int|null $pitching_ratings_vsl_wild_pitch
 * @property int|null $pitching_ratings_talent_stuff
 * @property int|null $pitching_ratings_talent_movement
 * @property int|null $pitching_ratings_talent_hra
 * @property int|null $pitching_ratings_talent_pbabip
 * @property int|null $pitching_ratings_talent_control
 * @property int|null $pitching_ratings_talent_balk
 * @property int|null $pitching_ratings_talent_hp
 * @property int|null $pitching_ratings_talent_wild_pitch
 * @property int|null $pitching_ratings_pitches_fastball
 * @property int|null $pitching_ratings_pitches_slider
 * @property int|null $pitching_ratings_pitches_curveball
 * @property int|null $pitching_ratings_pitches_screwball
 * @property int|null $pitching_ratings_pitches_forkball
 * @property int|null $pitching_ratings_pitches_changeup
 * @property int|null $pitching_ratings_pitches_sinker
 * @property int|null $pitching_ratings_pitches_splitter
 * @property int|null $pitching_ratings_pitches_knuckleball
 * @property int|null $pitching_ratings_pitches_cutter
 * @property int|null $pitching_ratings_pitches_circlechange
 * @property int|null $pitching_ratings_pitches_knucklecurve
 * @property int|null $pitching_ratings_pitches_talent_fastball
 * @property int|null $pitching_ratings_pitches_talent_slider
 * @property int|null $pitching_ratings_pitches_talent_curveball
 * @property int|null $pitching_ratings_pitches_talent_screwball
 * @property int|null $pitching_ratings_pitches_talent_forkball
 * @property int|null $pitching_ratings_pitches_talent_changeup
 * @property int|null $pitching_ratings_pitches_talent_sinker
 * @property int|null $pitching_ratings_pitches_talent_splitter
 * @property int|null $pitching_ratings_pitches_talent_knuckleball
 * @property int|null $pitching_ratings_pitches_talent_cutter
 * @property int|null $pitching_ratings_pitches_talent_circlechange
 * @property int|null $pitching_ratings_pitches_talent_knucklecurve
 * @property int|null $pitching_ratings_misc_velocity
 * @property int|null $pitching_ratings_misc_velocity_target
 * @property int|null $pitching_ratings_misc_arm_slot
 * @property int|null $pitching_ratings_misc_stamina
 * @property int|null $pitching_ratings_misc_ground_fly
 * @property int|null $pitching_ratings_misc_hold
 *
 * @package App\Models
 */
class PlayersPitching extends Model
{
	protected $table = 'players_pitching';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'team_id' => 'int',
		'league_id' => 'int',
		'position' => 'int',
		'role' => 'int',
		'pitching_ratings_overall_stuff' => 'int',
		'pitching_ratings_overall_movement' => 'int',
		'pitching_ratings_overall_hra' => 'int',
		'pitching_ratings_overall_pbabip' => 'int',
		'pitching_ratings_overall_control' => 'int',
		'pitching_ratings_overall_balk' => 'int',
		'pitching_ratings_overall_hp' => 'int',
		'pitching_ratings_overall_wild_pitch' => 'int',
		'pitching_ratings_vsr_stuff' => 'int',
		'pitching_ratings_vsr_movement' => 'int',
		'pitching_ratings_vsr_hra' => 'int',
		'pitching_ratings_vsr_pbabip' => 'int',
		'pitching_ratings_vsr_control' => 'int',
		'pitching_ratings_vsr_balk' => 'int',
		'pitching_ratings_vsr_hp' => 'int',
		'pitching_ratings_vsr_wild_pitch' => 'int',
		'pitching_ratings_vsl_stuff' => 'int',
		'pitching_ratings_vsl_movement' => 'int',
		'pitching_ratings_vsl_hra' => 'int',
		'pitching_ratings_vsl_pbabip' => 'int',
		'pitching_ratings_vsl_control' => 'int',
		'pitching_ratings_vsl_balk' => 'int',
		'pitching_ratings_vsl_hp' => 'int',
		'pitching_ratings_vsl_wild_pitch' => 'int',
		'pitching_ratings_talent_stuff' => 'int',
		'pitching_ratings_talent_movement' => 'int',
		'pitching_ratings_talent_hra' => 'int',
		'pitching_ratings_talent_pbabip' => 'int',
		'pitching_ratings_talent_control' => 'int',
		'pitching_ratings_talent_balk' => 'int',
		'pitching_ratings_talent_hp' => 'int',
		'pitching_ratings_talent_wild_pitch' => 'int',
		'pitching_ratings_pitches_fastball' => 'int',
		'pitching_ratings_pitches_slider' => 'int',
		'pitching_ratings_pitches_curveball' => 'int',
		'pitching_ratings_pitches_screwball' => 'int',
		'pitching_ratings_pitches_forkball' => 'int',
		'pitching_ratings_pitches_changeup' => 'int',
		'pitching_ratings_pitches_sinker' => 'int',
		'pitching_ratings_pitches_splitter' => 'int',
		'pitching_ratings_pitches_knuckleball' => 'int',
		'pitching_ratings_pitches_cutter' => 'int',
		'pitching_ratings_pitches_circlechange' => 'int',
		'pitching_ratings_pitches_knucklecurve' => 'int',
		'pitching_ratings_pitches_talent_fastball' => 'int',
		'pitching_ratings_pitches_talent_slider' => 'int',
		'pitching_ratings_pitches_talent_curveball' => 'int',
		'pitching_ratings_pitches_talent_screwball' => 'int',
		'pitching_ratings_pitches_talent_forkball' => 'int',
		'pitching_ratings_pitches_talent_changeup' => 'int',
		'pitching_ratings_pitches_talent_sinker' => 'int',
		'pitching_ratings_pitches_talent_splitter' => 'int',
		'pitching_ratings_pitches_talent_knuckleball' => 'int',
		'pitching_ratings_pitches_talent_cutter' => 'int',
		'pitching_ratings_pitches_talent_circlechange' => 'int',
		'pitching_ratings_pitches_talent_knucklecurve' => 'int',
		'pitching_ratings_misc_velocity' => 'int',
		'pitching_ratings_misc_velocity_target' => 'int',
		'pitching_ratings_misc_arm_slot' => 'int',
		'pitching_ratings_misc_stamina' => 'int',
		'pitching_ratings_misc_ground_fly' => 'int',
		'pitching_ratings_misc_hold' => 'int'
	];

	protected $fillable = [
		'player_id',
		'team_id',
		'league_id',
		'position',
		'role',
		'pitching_ratings_overall_stuff',
		'pitching_ratings_overall_movement',
		'pitching_ratings_overall_hra',
		'pitching_ratings_overall_pbabip',
		'pitching_ratings_overall_control',
		'pitching_ratings_overall_balk',
		'pitching_ratings_overall_hp',
		'pitching_ratings_overall_wild_pitch',
		'pitching_ratings_vsr_stuff',
		'pitching_ratings_vsr_movement',
		'pitching_ratings_vsr_hra',
		'pitching_ratings_vsr_pbabip',
		'pitching_ratings_vsr_control',
		'pitching_ratings_vsr_balk',
		'pitching_ratings_vsr_hp',
		'pitching_ratings_vsr_wild_pitch',
		'pitching_ratings_vsl_stuff',
		'pitching_ratings_vsl_movement',
		'pitching_ratings_vsl_hra',
		'pitching_ratings_vsl_pbabip',
		'pitching_ratings_vsl_control',
		'pitching_ratings_vsl_balk',
		'pitching_ratings_vsl_hp',
		'pitching_ratings_vsl_wild_pitch',
		'pitching_ratings_talent_stuff',
		'pitching_ratings_talent_movement',
		'pitching_ratings_talent_hra',
		'pitching_ratings_talent_pbabip',
		'pitching_ratings_talent_control',
		'pitching_ratings_talent_balk',
		'pitching_ratings_talent_hp',
		'pitching_ratings_talent_wild_pitch',
		'pitching_ratings_pitches_fastball',
		'pitching_ratings_pitches_slider',
		'pitching_ratings_pitches_curveball',
		'pitching_ratings_pitches_screwball',
		'pitching_ratings_pitches_forkball',
		'pitching_ratings_pitches_changeup',
		'pitching_ratings_pitches_sinker',
		'pitching_ratings_pitches_splitter',
		'pitching_ratings_pitches_knuckleball',
		'pitching_ratings_pitches_cutter',
		'pitching_ratings_pitches_circlechange',
		'pitching_ratings_pitches_knucklecurve',
		'pitching_ratings_pitches_talent_fastball',
		'pitching_ratings_pitches_talent_slider',
		'pitching_ratings_pitches_talent_curveball',
		'pitching_ratings_pitches_talent_screwball',
		'pitching_ratings_pitches_talent_forkball',
		'pitching_ratings_pitches_talent_changeup',
		'pitching_ratings_pitches_talent_sinker',
		'pitching_ratings_pitches_talent_splitter',
		'pitching_ratings_pitches_talent_knuckleball',
		'pitching_ratings_pitches_talent_cutter',
		'pitching_ratings_pitches_talent_circlechange',
		'pitching_ratings_pitches_talent_knucklecurve',
		'pitching_ratings_misc_velocity',
		'pitching_ratings_misc_velocity_target',
		'pitching_ratings_misc_arm_slot',
		'pitching_ratings_misc_stamina',
		'pitching_ratings_misc_ground_fly',
		'pitching_ratings_misc_hold'
	];
}
