<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PasswordResetToken
 *
 * @property int $id
 * @property int $user_id
 * @property string $code_hash
 * @property int $attempts
 * @property Carbon $expires_at
 * @property Carbon $created_at
 *
 * @property User $user
 */
class PasswordResetToken extends Model
{
    use HasFactory;

    protected $table = 'password_reset_tokens';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'code_hash',
        'attempts',
        'expires_at',
    ];

    protected $hidden = [
        'code_hash',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
		'attempts' => 'integer',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
	];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}