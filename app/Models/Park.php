<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Park
 * 
 * @property int $park_id
 * @property int|null $dimensions_x
 * @property int|null $dimensions_y
 * @property int|null $batter_left_x
 * @property int|null $batter_left_y
 * @property int|null $batter_right_x
 * @property int|null $batter_right_y
 * @property int|null $bases_x0
 * @property int|null $bases_x1
 * @property int|null $bases_x2
 * @property int|null $bases_y0
 * @property int|null $bases_y1
 * @property int|null $bases_y2
 * @property int|null $positions_x0
 * @property int|null $positions_x1
 * @property int|null $positions_x2
 * @property int|null $positions_x3
 * @property int|null $positions_x4
 * @property int|null $positions_x5
 * @property int|null $positions_x6
 * @property int|null $positions_x7
 * @property int|null $positions_x8
 * @property int|null $positions_x9
 * @property int|null $positions_y0
 * @property int|null $positions_y1
 * @property int|null $positions_y2
 * @property int|null $positions_y3
 * @property int|null $positions_y4
 * @property int|null $positions_y5
 * @property int|null $positions_y6
 * @property int|null $positions_y7
 * @property int|null $positions_y8
 * @property int|null $positions_y9
 * @property float|null $avg
 * @property float|null $avg_l
 * @property float|null $avg_r
 * @property float|null $d
 * @property float|null $t
 * @property float|null $hr
 * @property float|null $hr_r
 * @property float|null $hr_l
 * @property int|null $temperature0
 * @property int|null $temperature1
 * @property int|null $temperature2
 * @property int|null $temperature3
 * @property int|null $temperature4
 * @property int|null $temperature5
 * @property int|null $temperature6
 * @property int|null $temperature7
 * @property int|null $temperature8
 * @property int|null $temperature9
 * @property int|null $temperature10
 * @property int|null $temperature11
 * @property int|null $rain0
 * @property int|null $rain1
 * @property int|null $rain2
 * @property int|null $rain3
 * @property int|null $rain4
 * @property int|null $rain5
 * @property int|null $rain6
 * @property int|null $rain7
 * @property int|null $rain8
 * @property int|null $rain9
 * @property int|null $rain10
 * @property int|null $rain11
 * @property int|null $wind
 * @property int|null $wind_direction
 * @property int|null $distances0
 * @property int|null $distances1
 * @property int|null $distances2
 * @property int|null $distances3
 * @property int|null $distances4
 * @property int|null $distances5
 * @property int|null $distances6
 * @property int|null $wall_heights0
 * @property int|null $wall_heights1
 * @property int|null $wall_heights2
 * @property int|null $wall_heights3
 * @property int|null $wall_heights4
 * @property int|null $wall_heights5
 * @property int|null $wall_heights6
 * @property string|null $name
 * @property string|null $picture
 * @property string|null $picture_night
 * @property int|null $nation_id
 * @property int|null $capacity
 * @property int|null $type
 * @property int|null $foul_ground
 * @property int|null $turf
 * @property int|null $gender
 * @property string|null $model_folder
 * @property string|null $file_name_3d_model
 * @property int|null $home_team_dugout_is_at_first_base
 *
 * @package App\Models
 */
class Park extends Model
{
	protected $table = 'parks';
	protected $primaryKey = 'park_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'park_id' => 'int',
		'dimensions_x' => 'int',
		'dimensions_y' => 'int',
		'batter_left_x' => 'int',
		'batter_left_y' => 'int',
		'batter_right_x' => 'int',
		'batter_right_y' => 'int',
		'bases_x0' => 'int',
		'bases_x1' => 'int',
		'bases_x2' => 'int',
		'bases_y0' => 'int',
		'bases_y1' => 'int',
		'bases_y2' => 'int',
		'positions_x0' => 'int',
		'positions_x1' => 'int',
		'positions_x2' => 'int',
		'positions_x3' => 'int',
		'positions_x4' => 'int',
		'positions_x5' => 'int',
		'positions_x6' => 'int',
		'positions_x7' => 'int',
		'positions_x8' => 'int',
		'positions_x9' => 'int',
		'positions_y0' => 'int',
		'positions_y1' => 'int',
		'positions_y2' => 'int',
		'positions_y3' => 'int',
		'positions_y4' => 'int',
		'positions_y5' => 'int',
		'positions_y6' => 'int',
		'positions_y7' => 'int',
		'positions_y8' => 'int',
		'positions_y9' => 'int',
		'avg' => 'float',
		'avg_l' => 'float',
		'avg_r' => 'float',
		'd' => 'float',
		't' => 'float',
		'hr' => 'float',
		'hr_r' => 'float',
		'hr_l' => 'float',
		'temperature0' => 'int',
		'temperature1' => 'int',
		'temperature2' => 'int',
		'temperature3' => 'int',
		'temperature4' => 'int',
		'temperature5' => 'int',
		'temperature6' => 'int',
		'temperature7' => 'int',
		'temperature8' => 'int',
		'temperature9' => 'int',
		'temperature10' => 'int',
		'temperature11' => 'int',
		'rain0' => 'int',
		'rain1' => 'int',
		'rain2' => 'int',
		'rain3' => 'int',
		'rain4' => 'int',
		'rain5' => 'int',
		'rain6' => 'int',
		'rain7' => 'int',
		'rain8' => 'int',
		'rain9' => 'int',
		'rain10' => 'int',
		'rain11' => 'int',
		'wind' => 'int',
		'wind_direction' => 'int',
		'distances0' => 'int',
		'distances1' => 'int',
		'distances2' => 'int',
		'distances3' => 'int',
		'distances4' => 'int',
		'distances5' => 'int',
		'distances6' => 'int',
		'wall_heights0' => 'int',
		'wall_heights1' => 'int',
		'wall_heights2' => 'int',
		'wall_heights3' => 'int',
		'wall_heights4' => 'int',
		'wall_heights5' => 'int',
		'wall_heights6' => 'int',
		'nation_id' => 'int',
		'capacity' => 'int',
		'type' => 'int',
		'foul_ground' => 'int',
		'turf' => 'int',
		'gender' => 'int',
		'home_team_dugout_is_at_first_base' => 'int'
	];

	protected $fillable = [
		'dimensions_x',
		'dimensions_y',
		'batter_left_x',
		'batter_left_y',
		'batter_right_x',
		'batter_right_y',
		'bases_x0',
		'bases_x1',
		'bases_x2',
		'bases_y0',
		'bases_y1',
		'bases_y2',
		'positions_x0',
		'positions_x1',
		'positions_x2',
		'positions_x3',
		'positions_x4',
		'positions_x5',
		'positions_x6',
		'positions_x7',
		'positions_x8',
		'positions_x9',
		'positions_y0',
		'positions_y1',
		'positions_y2',
		'positions_y3',
		'positions_y4',
		'positions_y5',
		'positions_y6',
		'positions_y7',
		'positions_y8',
		'positions_y9',
		'avg',
		'avg_l',
		'avg_r',
		'd',
		't',
		'hr',
		'hr_r',
		'hr_l',
		'temperature0',
		'temperature1',
		'temperature2',
		'temperature3',
		'temperature4',
		'temperature5',
		'temperature6',
		'temperature7',
		'temperature8',
		'temperature9',
		'temperature10',
		'temperature11',
		'rain0',
		'rain1',
		'rain2',
		'rain3',
		'rain4',
		'rain5',
		'rain6',
		'rain7',
		'rain8',
		'rain9',
		'rain10',
		'rain11',
		'wind',
		'wind_direction',
		'distances0',
		'distances1',
		'distances2',
		'distances3',
		'distances4',
		'distances5',
		'distances6',
		'wall_heights0',
		'wall_heights1',
		'wall_heights2',
		'wall_heights3',
		'wall_heights4',
		'wall_heights5',
		'wall_heights6',
		'name',
		'picture',
		'picture_night',
		'nation_id',
		'capacity',
		'type',
		'foul_ground',
		'turf',
		'gender',
		'model_folder',
		'file_name_3d_model',
		'home_team_dugout_is_at_first_base'
	];
}
