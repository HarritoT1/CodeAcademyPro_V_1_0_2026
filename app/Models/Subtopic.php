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
 * Class Subtopic
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $topic_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Topic $topic
 * @property Collection|UserSubtopicProgress[] $subtopic_progresses
 *
 * @package App\Models
 */
class Subtopic extends Model
{
	use HasFactory;

	protected $table = 'subtopics';

	protected $casts = [
		'id' => 'integer',
		'topic_id' => 'integer',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'title',
		'content',
		'topic_id'
	];

	public function topic()
	{
		return $this->belongsTo(Topic::class, 'topic_id');
	}

	public function subtopic_progresses()
	{
		return $this->hasMany(UserSubtopicProgress::class, 'subtopic_id');
	}
}
