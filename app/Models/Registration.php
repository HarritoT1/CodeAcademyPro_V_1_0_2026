<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Registration
 * 
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Course $course
 * @property User $user
 *
 * @package App\Models
 */
class Registration extends Model
{
	protected $table = 'registrations';

	protected $casts = [
		'user_id' => 'int',
		'course_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'course_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
