<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamLastFinancial
 * 
 * @property int $team_id
 * @property int|null $gate_revenue
 * @property int|null $gate_share_gained
 * @property int|null $gate_share_lost
 * @property int|null $season_ticket_revenue
 * @property int|null $media_revenue
 * @property int|null $merchandising_revenue
 * @property int|null $revenue_sharing
 * @property int|null $luxury_sharing
 * @property int|null $playoff_revenue
 * @property int|null $cash
 * @property int|null $cash_owner
 * @property int|null $cash_trades
 * @property int|null $previous_balance
 * @property int|null $player_expenses
 * @property int|null $staff_expenses
 * @property int|null $stadium_expenses
 * @property int|null $season_tickets
 * @property int|null $attendance
 * @property int|null $fan_interest
 * @property int|null $fan_loyalty
 * @property int|null $fan_modifier
 * @property int|null $fan_interest_visible
 * @property float|null $ticket_price
 * @property int|null $local_media_contract
 * @property int|null $local_media_contract_expires
 * @property int|null $national_media_contract
 * @property int|null $national_media_contract_expires
 * @property int|null $scouting_budget
 * @property int|null $development_budget
 * @property int|null $draft_budget
 * @property int|null $draft_expenses
 * @property int|null $intl_fa_budget
 * @property int|null $spent_in_intl
 * @property int|null $budget
 * @property int|null $market
 * @property int|null $owner_expectation
 * @property int|null $total_revenue
 * @property int|null $total_expenses
 * @property int|null $financial_balance
 * @property int|null $budget_balance
 *
 * @package App\Models
 */
class TeamLastFinancial extends Model
{
	protected $table = 'team_last_financials';
	protected $primaryKey = 'team_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'gate_revenue' => 'int',
		'gate_share_gained' => 'int',
		'gate_share_lost' => 'int',
		'season_ticket_revenue' => 'int',
		'media_revenue' => 'int',
		'merchandising_revenue' => 'int',
		'revenue_sharing' => 'int',
		'luxury_sharing' => 'int',
		'playoff_revenue' => 'int',
		'cash' => 'int',
		'cash_owner' => 'int',
		'cash_trades' => 'int',
		'previous_balance' => 'int',
		'player_expenses' => 'int',
		'staff_expenses' => 'int',
		'stadium_expenses' => 'int',
		'season_tickets' => 'int',
		'attendance' => 'int',
		'fan_interest' => 'int',
		'fan_loyalty' => 'int',
		'fan_modifier' => 'int',
		'fan_interest_visible' => 'int',
		'ticket_price' => 'float',
		'local_media_contract' => 'int',
		'local_media_contract_expires' => 'int',
		'national_media_contract' => 'int',
		'national_media_contract_expires' => 'int',
		'scouting_budget' => 'int',
		'development_budget' => 'int',
		'draft_budget' => 'int',
		'draft_expenses' => 'int',
		'intl_fa_budget' => 'int',
		'spent_in_intl' => 'int',
		'budget' => 'int',
		'market' => 'int',
		'owner_expectation' => 'int',
		'total_revenue' => 'int',
		'total_expenses' => 'int',
		'financial_balance' => 'int',
		'budget_balance' => 'int'
	];

	protected $fillable = [
		'gate_revenue',
		'gate_share_gained',
		'gate_share_lost',
		'season_ticket_revenue',
		'media_revenue',
		'merchandising_revenue',
		'revenue_sharing',
		'luxury_sharing',
		'playoff_revenue',
		'cash',
		'cash_owner',
		'cash_trades',
		'previous_balance',
		'player_expenses',
		'staff_expenses',
		'stadium_expenses',
		'season_tickets',
		'attendance',
		'fan_interest',
		'fan_loyalty',
		'fan_modifier',
		'fan_interest_visible',
		'ticket_price',
		'local_media_contract',
		'local_media_contract_expires',
		'national_media_contract',
		'national_media_contract_expires',
		'scouting_budget',
		'development_budget',
		'draft_budget',
		'draft_expenses',
		'intl_fa_budget',
		'spent_in_intl',
		'budget',
		'market',
		'owner_expectation',
		'total_revenue',
		'total_expenses',
		'financial_balance',
		'budget_balance'
	];
}
