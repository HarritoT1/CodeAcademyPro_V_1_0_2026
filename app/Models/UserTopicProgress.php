<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserTopicProgress
 * 
 * @property int $id
 * @property int $user_id
 * @property int $topic_id
 * @property Carbon $completed_at
 * 
 * @property Topic $topic
 * @property User $user
 *
 * @package App\Models
 */
class UserTopicProgress extends Model
{
	protected $table = 'user_topic_progresses';
	
	public $timestamps = false;

	protected $casts = [
		'id' => 'integer',
		'user_id' => 'integer',
		'topic_id' => 'integer',
		'completed_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'topic_id',
	];

	public function topic()
	{
		return $this->belongsTo(Topic::class, 'topic_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
