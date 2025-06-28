<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamPitchingStat
 * 
 * @property int $team_id
 * @property int|null $year
 * @property int|null $league_id
 * @property int|null $level_id
 * @property int|null $split_id
 * @property int|null $ab
 * @property int|null $ip
 * @property int|null $bf
 * @property int|null $tb
 * @property int|null $ha
 * @property int|null $k
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
 * @property float|null $r9
 * @property float|null $avg
 * @property float|null $obp
 * @property float|null $slg
 * @property float|null $ops
 * @property float|null $h9
 * @property float|null $k9
 * @property float|null $hr9
 * @property float|null $bb9
 * @property float|null $cgp
 * @property float|null $fip
 * @property float|null $qsp
 * @property float|null $winp
 * @property float|null $rsg
 * @property float|null $svp
 * @property float|null $bsvp
 * @property float|null $gfp
 * @property float|null $era
 * @property float|null $pig
 * @property float|null $ws
 * @property float|null $whip
 * @property float|null $gbfbp
 * @property float|null $kbb
 * @property float|null $babip
 *
 * @package App\Models
 */
class TeamPitchingStat extends Model
{
	protected $table = 'team_pitching_stats';
	protected $primaryKey = 'team_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'year' => 'int',
		'league_id' => 'int',
		'level_id' => 'int',
		'split_id' => 'int',
		'ab' => 'int',
		'ip' => 'int',
		'bf' => 'int',
		'tb' => 'int',
		'ha' => 'int',
		'k' => 'int',
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
		'r9' => 'float',
		'avg' => 'float',
		'obp' => 'float',
		'slg' => 'float',
		'ops' => 'float',
		'h9' => 'float',
		'k9' => 'float',
		'hr9' => 'float',
		'bb9' => 'float',
		'cgp' => 'float',
		'fip' => 'float',
		'qsp' => 'float',
		'winp' => 'float',
		'rsg' => 'float',
		'svp' => 'float',
		'bsvp' => 'float',
		'gfp' => 'float',
		'era' => 'float',
		'pig' => 'float',
		'ws' => 'float',
		'whip' => 'float',
		'gbfbp' => 'float',
		'kbb' => 'float',
		'babip' => 'float'
	];

	protected $fillable = [
		'year',
		'league_id',
		'level_id',
		'split_id',
		'ab',
		'ip',
		'bf',
		'tb',
		'ha',
		'k',
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
		'r9',
		'avg',
		'obp',
		'slg',
		'ops',
		'h9',
		'k9',
		'hr9',
		'bb9',
		'cgp',
		'fip',
		'qsp',
		'winp',
		'rsg',
		'svp',
		'bsvp',
		'gfp',
		'era',
		'pig',
		'ws',
		'whip',
		'gbfbp',
		'kbb',
		'babip'
	];
}
