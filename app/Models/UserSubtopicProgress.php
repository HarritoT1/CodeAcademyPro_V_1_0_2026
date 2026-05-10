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
		'id' => 'integer',
		'user_id' => 'integer',
		'subtopic_id' => 'integer',
		'completed_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'subtopic_id',
	];

	public function subtopic()
	{
		return $this->belongsTo(Subtopic::class, 'subtopic_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
