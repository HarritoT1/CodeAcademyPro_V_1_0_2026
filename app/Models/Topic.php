<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $course_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Course $course
 * @property Collection|Subtopic[] $subtopics
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Topic extends Model
{
	protected $table = 'topics';

	protected $casts = [
		'course_id' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'course_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function subtopics()
	{
		return $this->hasMany(Subtopic::class);
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_topic_progresses')
					->withPivot('id', 'completed_at');
	}
}
