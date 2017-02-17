<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ResetPassword
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $code
 * @property boolean $confirmed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ResetPassword whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ResetPassword whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ResetPassword whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ResetPassword whereConfirmed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ResetPassword whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ResetPassword whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ResetPassword extends Model
{
    /**
     * Связь с пользователем.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
