<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
 * @property Collection|Registration[] $registrations
 * @property Collection|Session[] $sessions
 * @property Collection|Subtopic[] $subtopics
 * @property Collection|Topic[] $topics
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'is_active' => 'bool',
		'rol_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'fullname',
		'name',
		'password',
		'email',
		'email_verified_at',
		'is_active',
		'phone_number',
		'home_address',
		'description',
		'avatar_url',
		'remember_token',
		'rol_id',
		'google_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'rol_id');
	}

	public function password_reset_token()
	{
		return $this->hasOne(PasswordResetToken::class);
	}

	public function registrations()
	{
		return $this->hasMany(Registration::class);
	}

	public function sessions()
	{
		return $this->hasMany(Session::class);
	}

	public function subtopics()
	{
		return $this->belongsToMany(Subtopic::class, 'user_subtopic_progresses')
					->withPivot('id', 'completed_at');
	}

	public function topics()
	{
		return $this->belongsToMany(Topic::class, 'user_topic_progresses')
					->withPivot('id', 'completed_at');
	}
}
