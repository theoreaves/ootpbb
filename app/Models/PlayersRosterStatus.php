<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersRosterStatus
 * 
 * @property int|null $player_id
 * @property int|null $team_id
 * @property int|null $league_id
 * @property int|null $position
 * @property int|null $role
 * @property int|null $playing_level
 * @property int|null $is_active
 * @property int|null $is_on_secondary
 * @property int|null $is_on_dl
 * @property int|null $is_on_dl60
 * @property int|null $must_be_active
 * @property int|null $just_signed
 * @property int|null $was_on_active
 * @property int|null $was_on_secondary
 * @property int|null $was_on_dl
 * @property int|null $mlb_service_years
 * @property int|null $secondary_service_years
 * @property int|null $pro_service_years
 * @property int|null $mlb_service_days
 * @property int|null $secondary_service_days
 * @property int|null $pro_service_days
 * @property int|null $mlb_service_days_this_year
 * @property int|null $secondary_service_days_this_year
 * @property int|null $pro_service_days_this_year
 * @property int|null $dl_days_this_year
 * @property int|null $years_protected_from_rule_5
 * @property int|null $is_on_waivers
 * @property int|null $designated_for_assignment
 * @property int|null $irrevocable_waivers
 * @property int|null $days_on_waivers
 * @property int|null $days_on_waivers_left
 * @property int|null $days_on_dfa_left
 * @property int|null $claimed_team_id
 * @property int|null $options_used
 * @property int|null $options_used_this_year
 * @property int|null $has_received_arbitration
 * @property int|null $was_traded
 * @property int|null $trade_status
 *
 * @package App\Models
 */
class PlayersRosterStatus extends Model
{
	protected $table = 'players_roster_status';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'team_id' => 'int',
		'league_id' => 'int',
		'position' => 'int',
		'role' => 'int',
		'playing_level' => 'int',
		'is_active' => 'int',
		'is_on_secondary' => 'int',
		'is_on_dl' => 'int',
		'is_on_dl60' => 'int',
		'must_be_active' => 'int',
		'just_signed' => 'int',
		'was_on_active' => 'int',
		'was_on_secondary' => 'int',
		'was_on_dl' => 'int',
		'mlb_service_years' => 'int',
		'secondary_service_years' => 'int',
		'pro_service_years' => 'int',
		'mlb_service_days' => 'int',
		'secondary_service_days' => 'int',
		'pro_service_days' => 'int',
		'mlb_service_days_this_year' => 'int',
		'secondary_service_days_this_year' => 'int',
		'pro_service_days_this_year' => 'int',
		'dl_days_this_year' => 'int',
		'years_protected_from_rule_5' => 'int',
		'is_on_waivers' => 'int',
		'designated_for_assignment' => 'int',
		'irrevocable_waivers' => 'int',
		'days_on_waivers' => 'int',
		'days_on_waivers_left' => 'int',
		'days_on_dfa_left' => 'int',
		'claimed_team_id' => 'int',
		'options_used' => 'int',
		'options_used_this_year' => 'int',
		'has_received_arbitration' => 'int',
		'was_traded' => 'int',
		'trade_status' => 'int'
	];

	protected $fillable = [
		'player_id',
		'team_id',
		'league_id',
		'position',
		'role',
		'playing_level',
		'is_active',
		'is_on_secondary',
		'is_on_dl',
		'is_on_dl60',
		'must_be_active',
		'just_signed',
		'was_on_active',
		'was_on_secondary',
		'was_on_dl',
		'mlb_service_years',
		'secondary_service_years',
		'pro_service_years',
		'mlb_service_days',
		'secondary_service_days',
		'pro_service_days',
		'mlb_service_days_this_year',
		'secondary_service_days_this_year',
		'pro_service_days_this_year',
		'dl_days_this_year',
		'years_protected_from_rule_5',
		'is_on_waivers',
		'designated_for_assignment',
		'irrevocable_waivers',
		'days_on_waivers',
		'days_on_waivers_left',
		'days_on_dfa_left',
		'claimed_team_id',
		'options_used',
		'options_used_this_year',
		'has_received_arbitration',
		'was_traded',
		'trade_status'
	];
}
