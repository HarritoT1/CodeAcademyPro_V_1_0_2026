<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Subtopic extends Model
{
	protected $table = 'subtopics';

	protected $casts = [
		'topic_id' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'topic_id'
	];

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_subtopic_progresses')
					->withPivot('id', 'completed_at');
	}
}
