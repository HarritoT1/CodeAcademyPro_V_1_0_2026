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
 * Class Role
 * 
 * @property int $id
 * @property string $role_name
 * @property string $slug
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{
	use HasFactory;

	protected $table = 'roles';

	protected $fillable = [
		'role_name',
		'slug',
		'description'
	];

	protected $casts = [
		'id' => 'integer',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'rol_id');
	}
}
