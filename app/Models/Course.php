<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
 * @property Collection|User[] $users
 * @property Collection|Topic[] $topics
 *
 * @package App\Models
 */
class Course extends Model
{
	use HasFactory;

	protected $table = 'courses';

	protected $casts = [
		'id' => 'integer',
		'duration' => 'float',
		'is_visible' => 'boolean',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'course_name',
		'image_url',
		'description',
		'programming_language',
		'duration',
		'is_visible'
	];

	public function users()
	{
    	return $this->belongsToMany(User::class, 'registrations', 'course_id', 'user_id');
	}

	public function topics()
	{
		return $this->hasMany(Topic::class, 'course_id');
	}
}
