<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string|null $fullname
 * @property string $name
 * @property string|null $password
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property bool $is_active
 * @property string|null $phone_number
 * @property string|null $home_address
 * @property string|null $description
 * @property string $avatar_url
 * @property string|null $remember_token
 * @property int|null $rol_id
 * @property string|null $google_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Role|null $role
 * @property PasswordResetToken|null $password_reset_token
 * @property Collection|Course[] $courses
 * @property Collection|UserTopicProgress[] $topic_progresses
 * @property Collection|UserSubtopicProgress[] $subtopic_progresses
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasFactory;

	protected $table = 'users';

	protected $casts = [
		'id' => 'integer',
		'rol_id' => 'integer',
		'email_verified_at' => 'datetime',
		'is_active' => 'boolean',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'google_id',
	];

	protected $fillable = [
		'fullname',
		'name',
		'password',
		'email',
		'phone_number',
		'home_address',
		'description',
		'avatar_url',
		'rol_id',
		'google_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'rol_id');
	}

	public function password_reset_token()
	{
		return $this->hasOne(PasswordResetToken::class, 'user_id');
	}

	public function courses()
	{
		return $this->belongsToMany(Course::class, 'registrations', 'user_id', 'course_id');
	}

	public function topic_progresses()
	{
		return $this->hasMany(UserTopicProgress::class, 'user_id');
	}

	public function subtopic_progresses()
	{
		return $this->hasMany(UserSubtopicProgress::class, 'user_id');
	}
}
