<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $message_id
 * @property string|null $subject
 * @property int|null $player_id_0
 * @property int|null $player_id_1
 * @property int|null $player_id_2
 * @property int|null $player_id_3
 * @property int|null $player_id_4
 * @property int|null $player_id_5
 * @property int|null $player_id_6
 * @property int|null $player_id_7
 * @property int|null $player_id_8
 * @property int|null $player_id_9
 * @property int|null $team_id_0
 * @property int|null $team_id_1
 * @property int|null $team_id_2
 * @property int|null $team_id_3
 * @property int|null $team_id_4
 * @property int|null $league_id_0
 * @property int|null $league_id_1
 * @property int|null $importance
 * @property int|null $message_type
 * @property int|null $hype
 * @property int|null $sender_type
 * @property int|null $sender_id
 * @property int|null $recipient_id
 * @property int|null $trade_id
 * @property Carbon|null $date
 * @property int|null $deleted
 * @property int|null $notify
 * @property int|null $ongoing_story_id
 * @property int|null $text_is_modified
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'messages';
	protected $primaryKey = 'message_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'message_id' => 'int',
		'player_id_0' => 'int',
		'player_id_1' => 'int',
		'player_id_2' => 'int',
		'player_id_3' => 'int',
		'player_id_4' => 'int',
		'player_id_5' => 'int',
		'player_id_6' => 'int',
		'player_id_7' => 'int',
		'player_id_8' => 'int',
		'player_id_9' => 'int',
		'team_id_0' => 'int',
		'team_id_1' => 'int',
		'team_id_2' => 'int',
		'team_id_3' => 'int',
		'team_id_4' => 'int',
		'league_id_0' => 'int',
		'league_id_1' => 'int',
		'importance' => 'int',
		'message_type' => 'int',
		'hype' => 'int',
		'sender_type' => 'int',
		'sender_id' => 'int',
		'recipient_id' => 'int',
		'trade_id' => 'int',
		'date' => 'datetime',
		'deleted' => 'int',
		'notify' => 'int',
		'ongoing_story_id' => 'int',
		'text_is_modified' => 'int'
	];

	protected $fillable = [
		'subject',
		'player_id_0',
		'player_id_1',
		'player_id_2',
		'player_id_3',
		'player_id_4',
		'player_id_5',
		'player_id_6',
		'player_id_7',
		'player_id_8',
		'player_id_9',
		'team_id_0',
		'team_id_1',
		'team_id_2',
		'team_id_3',
		'team_id_4',
		'league_id_0',
		'league_id_1',
		'importance',
		'message_type',
		'hype',
		'sender_type',
		'sender_id',
		'recipient_id',
		'trade_id',
		'date',
		'deleted',
		'notify',
		'ongoing_story_id',
		'text_is_modified'
	];
}
