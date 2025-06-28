<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * 
 * @property int $state_id
 * @property int $nation_id
 * @property string|null $name
 * @property string|null $abbreviation
 * @property int|null $population
 * @property int|null $main_language_id
 *
 * @package App\Models
 */
class State extends Model
{
	protected $table = 'states';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'state_id' => 'int',
		'nation_id' => 'int',
		'population' => 'int',
		'main_language_id' => 'int'
	];

	protected $fillable = [
		'name',
		'abbreviation',
		'population',
		'main_language_id'
	];
}
