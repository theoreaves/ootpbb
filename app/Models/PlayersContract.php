<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersContract
 * 
 * @property int|null $player_id
 * @property int|null $team_id
 * @property int|null $league_id
 * @property int|null $position
 * @property int|null $role
 * @property int|null $is_major
 * @property int|null $no_trade
 * @property int|null $last_year_team_option
 * @property int|null $last_year_player_option
 * @property int|null $last_year_vesting_option
 * @property int|null $next_last_year_team_option
 * @property int|null $next_last_year_player_option
 * @property int|null $next_last_year_vesting_option
 * @property int|null $contract_team_id
 * @property int|null $contract_league_id
 * @property int|null $season_year
 * @property int|null $salary0
 * @property int|null $salary1
 * @property int|null $salary2
 * @property int|null $salary3
 * @property int|null $salary4
 * @property int|null $salary5
 * @property int|null $salary6
 * @property int|null $salary7
 * @property int|null $salary8
 * @property int|null $salary9
 * @property int|null $salary10
 * @property int|null $salary11
 * @property int|null $salary12
 * @property int|null $salary13
 * @property int|null $salary14
 * @property int|null $years
 * @property int|null $current_year
 * @property int|null $minimum_pa
 * @property int|null $minimum_pa_bonus
 * @property int|null $minimum_ip
 * @property int|null $minimum_ip_bonus
 * @property int|null $mvp_bonus
 * @property int|null $cyyoung_bonus
 * @property int|null $allstar_bonus
 * @property int|null $next_last_year_option_buyout
 * @property int|null $last_year_option_buyout
 * @property int|null $opt_out
 * @property int|null $opt_out_relegation
 * @property int|null $retained
 *
 * @package App\Models
 */
class PlayersContract extends Model
{
	protected $table = 'players_contract';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'team_id' => 'int',
		'league_id' => 'int',
		'position' => 'int',
		'role' => 'int',
		'is_major' => 'int',
		'no_trade' => 'int',
		'last_year_team_option' => 'int',
		'last_year_player_option' => 'int',
		'last_year_vesting_option' => 'int',
		'next_last_year_team_option' => 'int',
		'next_last_year_player_option' => 'int',
		'next_last_year_vesting_option' => 'int',
		'contract_team_id' => 'int',
		'contract_league_id' => 'int',
		'season_year' => 'int',
		'salary0' => 'int',
		'salary1' => 'int',
		'salary2' => 'int',
		'salary3' => 'int',
		'salary4' => 'int',
		'salary5' => 'int',
		'salary6' => 'int',
		'salary7' => 'int',
		'salary8' => 'int',
		'salary9' => 'int',
		'salary10' => 'int',
		'salary11' => 'int',
		'salary12' => 'int',
		'salary13' => 'int',
		'salary14' => 'int',
		'years' => 'int',
		'current_year' => 'int',
		'minimum_pa' => 'int',
		'minimum_pa_bonus' => 'int',
		'minimum_ip' => 'int',
		'minimum_ip_bonus' => 'int',
		'mvp_bonus' => 'int',
		'cyyoung_bonus' => 'int',
		'allstar_bonus' => 'int',
		'next_last_year_option_buyout' => 'int',
		'last_year_option_buyout' => 'int',
		'opt_out' => 'int',
		'opt_out_relegation' => 'int',
		'retained' => 'int'
	];

	protected $fillable = [
		'player_id',
		'team_id',
		'league_id',
		'position',
		'role',
		'is_major',
		'no_trade',
		'last_year_team_option',
		'last_year_player_option',
		'last_year_vesting_option',
		'next_last_year_team_option',
		'next_last_year_player_option',
		'next_last_year_vesting_option',
		'contract_team_id',
		'contract_league_id',
		'season_year',
		'salary0',
		'salary1',
		'salary2',
		'salary3',
		'salary4',
		'salary5',
		'salary6',
		'salary7',
		'salary8',
		'salary9',
		'salary10',
		'salary11',
		'salary12',
		'salary13',
		'salary14',
		'years',
		'current_year',
		'minimum_pa',
		'minimum_pa_bonus',
		'minimum_ip',
		'minimum_ip_bonus',
		'mvp_bonus',
		'cyyoung_bonus',
		'allstar_bonus',
		'next_last_year_option_buyout',
		'last_year_option_buyout',
		'opt_out',
		'opt_out_relegation',
		'retained'
	];
}
