<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamRosterStaff
 * 
 * @property int $team_id
 * @property int|null $head_scout
 * @property int|null $manager
 * @property int|null $general_manager
 * @property int|null $pitching_coach
 * @property int|null $hitting_coach
 * @property int|null $bench_coach
 * @property int|null $owner
 * @property int|null $doctor
 * @property int|null $first_base_coach
 * @property int|null $third_base_coach
 *
 * @package App\Models
 */
class TeamRosterStaff extends Model
{
	protected $table = 'team_roster_staff';
	protected $primaryKey = 'team_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'head_scout' => 'int',
		'manager' => 'int',
		'general_manager' => 'int',
		'pitching_coach' => 'int',
		'hitting_coach' => 'int',
		'bench_coach' => 'int',
		'owner' => 'int',
		'doctor' => 'int',
		'first_base_coach' => 'int',
		'third_base_coach' => 'int'
	];

	protected $fillable = [
		'head_scout',
		'manager',
		'general_manager',
		'pitching_coach',
		'hitting_coach',
		'bench_coach',
		'owner',
		'doctor',
		'first_base_coach',
		'third_base_coach'
	];
}
