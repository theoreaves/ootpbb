<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersAward
 *
 * @property int|null $player_id
 * @property int|null $league_id
 * @property int|null $team_id
 * @property int|null $sub_league_id
 * @property int|null $award_id
 * @property int|null $year
 * @property int|null $season
 * @property int|null $position
 * @property int|null $day
 * @property int|null $month
 * @property int|null $finish
 *
 * @package App\Models
 */
class PlayersAward extends Model
{
	protected $table = 'players_awards';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'league_id' => 'int',
		'team_id' => 'int',
		'sub_league_id' => 'int',
		'award_id' => 'int',
		'year' => 'int',
		'season' => 'int',
		'position' => 'int',
		'day' => 'int',
		'month' => 'int',
		'finish' => 'int'
	];

	protected $fillable = [
		'player_id',
		'league_id',
		'team_id',
		'sub_league_id',
		'award_id',
		'year',
		'season',
		'position',
		'day',
		'month',
		'finish'
	];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
    public function league()
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function sub_league()
    {
        return $this->belongsTo(SubLeague::class, 'sub_league_id');
    }

    public function getAwardnameAttribute()
    {
        $positions = [
            0 => 'Unknown',
            1 => 'Pitcher',
            2 => 'Catcher',
            3 => 'First Base',
            4 => 'Second Base',
            5 => 'Third Base',
            6 => 'Shortstop',
            7 => 'Left Field',
            8 => 'Center Field',
            9 => 'Right Field',
        ];

        $awards = [
            0 => 'Player of the Week',
            1 => 'Pitcher of the Month',
            2 => 'Batter of the Month',
            3 => 'Rookie of the Month',
            4 => 'Pitcher of the Year',
            5 => 'Most Valuable Player',
            6 => 'Rookie of the Year',
            7 => 'Fielder of the Year',
            9 => 'All-Star',
            11 => 'Silver Slugger',
            14 => 'League Champion',
        ];
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            '10' => 'October',
            11 => 'November',
            12 => 'December',
        ];

        if ($this->award_id== 0) {
            return 'Player of the Week - ' . ($this->month . '/'. $this->day . '/' . $this->year);
        }

        if ($this->award_id == 1) {
            return 'Pitcher of the Month - ' . $months[$this->month];
        }
        if ($this->award_id == 2) {
            return 'Batter of the Month - ' .  $months[$this->month];
        }
        if ($this->award_id == 3) {
            return 'Rookie of the Month - ' .  $months[$this->month];
        }


        if ($this->award_id == 7){
            return 'Gold Glove - ' . ($positions[$this->position] ?? 'Unknown Position');
        }
        if ($this->award_id == 11){
            return 'Silver Slugger - ' . ($positions[$this->position] ?? 'Unknown Position');
        }

        return $awards[$this->award_id] ?? 'Unknown Award';
    }
}
