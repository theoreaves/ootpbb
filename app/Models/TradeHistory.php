<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TradeHistory
 * 
 * @property Carbon|null $date
 * @property string|null $summary
 * @property int|null $message_id
 * @property int|null $team_id_0
 * @property int|null $player_id_0_0
 * @property int|null $player_id_0_1
 * @property int|null $player_id_0_2
 * @property int|null $player_id_0_3
 * @property int|null $player_id_0_4
 * @property int|null $player_id_0_5
 * @property int|null $player_id_0_6
 * @property int|null $player_id_0_7
 * @property int|null $player_id_0_8
 * @property int|null $player_id_0_9
 * @property int|null $draft_round_0_0
 * @property int|null $draft_team_0_0
 * @property int|null $draft_round_0_1
 * @property int|null $draft_team_0_1
 * @property int|null $draft_round_0_2
 * @property int|null $draft_team_0_2
 * @property int|null $draft_round_0_3
 * @property int|null $draft_team_0_3
 * @property int|null $draft_round_0_4
 * @property int|null $draft_team_0_4
 * @property int|null $cash_0
 * @property int|null $iafa_cap_0
 * @property int|null $team_id_1
 * @property int|null $player_id_1_0
 * @property int|null $player_id_1_1
 * @property int|null $player_id_1_2
 * @property int|null $player_id_1_3
 * @property int|null $player_id_1_4
 * @property int|null $player_id_1_5
 * @property int|null $player_id_1_6
 * @property int|null $player_id_1_7
 * @property int|null $player_id_1_8
 * @property int|null $player_id_1_9
 * @property int|null $draft_round_1_0
 * @property int|null $draft_team_1_0
 * @property int|null $draft_round_1_1
 * @property int|null $draft_team_1_1
 * @property int|null $draft_round_1_2
 * @property int|null $draft_team_1_2
 * @property int|null $draft_round_1_3
 * @property int|null $draft_team_1_3
 * @property int|null $draft_round_1_4
 * @property int|null $draft_team_1_4
 * @property int|null $cash_1
 * @property int|null $iafa_cap_1
 *
 * @package App\Models
 */
class TradeHistory extends Model
{
	protected $table = 'trade_history';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'message_id' => 'int',
		'team_id_0' => 'int',
		'player_id_0_0' => 'int',
		'player_id_0_1' => 'int',
		'player_id_0_2' => 'int',
		'player_id_0_3' => 'int',
		'player_id_0_4' => 'int',
		'player_id_0_5' => 'int',
		'player_id_0_6' => 'int',
		'player_id_0_7' => 'int',
		'player_id_0_8' => 'int',
		'player_id_0_9' => 'int',
		'draft_round_0_0' => 'int',
		'draft_team_0_0' => 'int',
		'draft_round_0_1' => 'int',
		'draft_team_0_1' => 'int',
		'draft_round_0_2' => 'int',
		'draft_team_0_2' => 'int',
		'draft_round_0_3' => 'int',
		'draft_team_0_3' => 'int',
		'draft_round_0_4' => 'int',
		'draft_team_0_4' => 'int',
		'cash_0' => 'int',
		'iafa_cap_0' => 'int',
		'team_id_1' => 'int',
		'player_id_1_0' => 'int',
		'player_id_1_1' => 'int',
		'player_id_1_2' => 'int',
		'player_id_1_3' => 'int',
		'player_id_1_4' => 'int',
		'player_id_1_5' => 'int',
		'player_id_1_6' => 'int',
		'player_id_1_7' => 'int',
		'player_id_1_8' => 'int',
		'player_id_1_9' => 'int',
		'draft_round_1_0' => 'int',
		'draft_team_1_0' => 'int',
		'draft_round_1_1' => 'int',
		'draft_team_1_1' => 'int',
		'draft_round_1_2' => 'int',
		'draft_team_1_2' => 'int',
		'draft_round_1_3' => 'int',
		'draft_team_1_3' => 'int',
		'draft_round_1_4' => 'int',
		'draft_team_1_4' => 'int',
		'cash_1' => 'int',
		'iafa_cap_1' => 'int'
	];

	protected $fillable = [
		'date',
		'summary',
		'message_id',
		'team_id_0',
		'player_id_0_0',
		'player_id_0_1',
		'player_id_0_2',
		'player_id_0_3',
		'player_id_0_4',
		'player_id_0_5',
		'player_id_0_6',
		'player_id_0_7',
		'player_id_0_8',
		'player_id_0_9',
		'draft_round_0_0',
		'draft_team_0_0',
		'draft_round_0_1',
		'draft_team_0_1',
		'draft_round_0_2',
		'draft_team_0_2',
		'draft_round_0_3',
		'draft_team_0_3',
		'draft_round_0_4',
		'draft_team_0_4',
		'cash_0',
		'iafa_cap_0',
		'team_id_1',
		'player_id_1_0',
		'player_id_1_1',
		'player_id_1_2',
		'player_id_1_3',
		'player_id_1_4',
		'player_id_1_5',
		'player_id_1_6',
		'player_id_1_7',
		'player_id_1_8',
		'player_id_1_9',
		'draft_round_1_0',
		'draft_team_1_0',
		'draft_round_1_1',
		'draft_team_1_1',
		'draft_round_1_2',
		'draft_team_1_2',
		'draft_round_1_3',
		'draft_team_1_3',
		'draft_round_1_4',
		'draft_team_1_4',
		'cash_1',
		'iafa_cap_1'
	];
}
