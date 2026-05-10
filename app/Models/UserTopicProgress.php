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
		'user_id' => 'int',
		'topic_id' => 'int',
		'completed_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'topic_id',
		'completed_at'
	];

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
