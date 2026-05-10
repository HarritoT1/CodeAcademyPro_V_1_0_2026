<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int $id
 * @property string $course_name
 * @property string $image_url
 * @property string $description
 * @property string $programming_language
 * @property float $duration
 * @property bool $is_visible
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Registration[] $registrations
 * @property Collection|Topic[] $topics
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';

	protected $casts = [
		'duration' => 'float',
		'is_visible' => 'bool'
	];

	protected $fillable = [
		'course_name',
		'image_url',
		'description',
		'programming_language',
		'duration',
		'is_visible'
	];

	public function registrations()
	{
		return $this->hasMany(Registration::class);
	}

	public function topics()
	{
		return $this->hasMany(Topic::class);
	}
}
