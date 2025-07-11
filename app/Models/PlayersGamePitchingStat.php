<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayersGamePitchingStat
 *
 * @property int|null $player_id
 * @property int|null $year
 * @property int|null $team_id
 * @property int|null $game_id
 * @property int|null $league_id
 * @property int|null $level_id
 * @property int|null $split_id
 * @property int|null $ip
 * @property int|null $ab
 * @property int|null $tb
 * @property int|null $ha
 * @property int|null $k
 * @property int|null $bf
 * @property int|null $rs
 * @property int|null $bb
 * @property int|null $r
 * @property int|null $er
 * @property int|null $gb
 * @property int|null $fb
 * @property int|null $pi
 * @property int|null $ipf
 * @property int|null $g
 * @property int|null $gs
 * @property int|null $w
 * @property int|null $l
 * @property int|null $s
 * @property int|null $sa
 * @property int|null $da
 * @property int|null $sh
 * @property int|null $sf
 * @property int|null $ta
 * @property int|null $hra
 * @property int|null $bk
 * @property int|null $ci
 * @property int|null $iw
 * @property int|null $wp
 * @property int|null $hp
 * @property int|null $gf
 * @property int|null $dp
 * @property int|null $qs
 * @property int|null $svo
 * @property int|null $bs
 * @property int|null $ra
 * @property int|null $cg
 * @property int|null $sho
 * @property int|null $sb
 * @property int|null $cs
 * @property int|null $hld
 * @property float|null $ir
 * @property float|null $irs
 * @property float|null $wpa
 * @property float|null $li
 * @property int|null $stint
 * @property int|null $outs
 * @property int|null $sd
 * @property int|null $md
 *
 * @package App\Models
 */
class PlayersGamePitchingStat extends Model
{
	protected $table = 'players_game_pitching_stats';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'player_id' => 'int',
		'year' => 'int',
		'team_id' => 'int',
		'game_id' => 'int',
		'league_id' => 'int',
		'level_id' => 'int',
		'split_id' => 'int',
		'ip' => 'int',
		'ab' => 'int',
		'tb' => 'int',
		'ha' => 'int',
		'k' => 'int',
		'bf' => 'int',
		'rs' => 'int',
		'bb' => 'int',
		'r' => 'int',
		'er' => 'int',
		'gb' => 'int',
		'fb' => 'int',
		'pi' => 'int',
		'ipf' => 'int',
		'g' => 'int',
		'gs' => 'int',
		'w' => 'int',
		'l' => 'int',
		's' => 'int',
		'sa' => 'int',
		'da' => 'int',
		'sh' => 'int',
		'sf' => 'int',
		'ta' => 'int',
		'hra' => 'int',
		'bk' => 'int',
		'ci' => 'int',
		'iw' => 'int',
		'wp' => 'int',
		'hp' => 'int',
		'gf' => 'int',
		'dp' => 'int',
		'qs' => 'int',
		'svo' => 'int',
		'bs' => 'int',
		'ra' => 'int',
		'cg' => 'int',
		'sho' => 'int',
		'sb' => 'int',
		'cs' => 'int',
		'hld' => 'int',
		'ir' => 'float',
		'irs' => 'float',
		'wpa' => 'float',
		'li' => 'float',
		'stint' => 'int',
		'outs' => 'int',
		'sd' => 'int',
		'md' => 'int'
	];

	protected $fillable = [
		'player_id',
		'year',
		'team_id',
		'game_id',
		'league_id',
		'level_id',
		'split_id',
		'ip',
		'ab',
		'tb',
		'ha',
		'k',
		'bf',
		'rs',
		'bb',
		'r',
		'er',
		'gb',
		'fb',
		'pi',
		'ipf',
		'g',
		'gs',
		'w',
		'l',
		's',
		'sa',
		'da',
		'sh',
		'sf',
		'ta',
		'hra',
		'bk',
		'ci',
		'iw',
		'wp',
		'hp',
		'gf',
		'dp',
		'qs',
		'svo',
		'bs',
		'ra',
		'cg',
		'sho',
		'sb',
		'cs',
		'hld',
		'ir',
		'irs',
		'wpa',
		'li',
		'stint',
		'outs',
		'sd',
		'md'
	];
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function getPostGameEraAttribute()
    {
        if (! $this->player_id || ! $this->year || ! $this->game || ! $this->game->date) {
            return null;
        }

        $gameDate = \Carbon\Carbon::parse($this->game->date)->toDateString();

        $prior = self::where('player_id', $this->player_id)
            ->where('year', $this->year)
            ->whereHas('game', function ($query) use ($gameDate) {
                $query->where('game_type', 0)
                    ->whereDate('date', '<', $gameDate);
            })
            ->selectRaw('SUM(ip) as ip, SUM(er) as er')
            ->first();

        $preIp = $prior->ip ?? 0;
        $preEr = $prior->er ?? 0;

        $totalIp = $preIp + $this->ip;
        $totalEr = $preEr + $this->er;

        return $totalIp > 0 ? round(($totalEr * 9) / $totalIp, 2) : null;
    }

}
