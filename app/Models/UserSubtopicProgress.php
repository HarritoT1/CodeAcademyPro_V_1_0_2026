<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSubtopicProgress
 * 
 * @property int $id
 * @property int $user_id
 * @property int $subtopic_id
 * @property Carbon $completed_at
 * 
 * @property Subtopic $subtopic
 * @property User $user
 *
 * @package App\Models
 */
class UserSubtopicProgress extends Model
{
	protected $table = 'user_subtopic_progresses';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'subtopic_id' => 'int',
		'completed_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'subtopic_id',
		'completed_at'
	];

	public function subtopic()
	{
		return $this->belongsTo(Subtopic::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
