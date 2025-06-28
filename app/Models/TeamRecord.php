<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamRecord
 *
 * @property int $team_id
 * @property int|null $g
 * @property int|null $w
 * @property int|null $l
 * @property int|null $t
 * @property int|null $pos
 * @property float|null $pct
 * @property float|null $gb
 * @property int|null $streak
 * @property int|null $magic_number
 *
 * @package App\Models
 */
class TeamRecord extends Model
{
	protected $table = 'team_record';
	protected $primaryKey = 'team_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'team_id' => 'int',
		'g' => 'int',
		'w' => 'int',
		'l' => 'int',
		't' => 'int',
		'pos' => 'int',
		'pct' => 'float',
		'gb' => 'float',
		'streak' => 'int',
		'magic_number' => 'int'
	];

	protected $fillable = [
		'g',
		'w',
		'l',
		't',
		'pos',
		'pct',
		'gb',
		'streak',
		'magic_number'
	];


    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }

}
