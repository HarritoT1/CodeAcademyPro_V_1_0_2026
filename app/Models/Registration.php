<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Registration
 * 
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Registration extends Model
{
	use HasFactory;

	protected $table = 'registrations';

	protected $casts = [
		'id' => 'integer',
		'user_id' => 'integer',
		'course_id' => 'integer',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	protected $fillable = [
		'user_id',
		'course_id'
	];
}
