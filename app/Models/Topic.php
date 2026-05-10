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
 * @property Collection|UserTopicProgress[] $topic_progresses
 *
 * @package App\Models
 */
class Topic extends Model
{
	use HasFactory;

	protected $table = 'topics';

	protected $casts = [
		'id' => 'integer',
		'course_id' => 'integer',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'title',
		'content',
		'course_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class, 'course_id');
	}

	public function subtopics()
	{
		return $this->hasMany(Subtopic::class, 'topic_id');
	}

	public function topic_progresses()
	{
		return $this->hasMany(UserTopicProgress::class, 'topic_id');
	}
}
