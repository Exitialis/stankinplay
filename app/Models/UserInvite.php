<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvite extends Model
{
    public function inviter()
    {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    public function invited()
    {
        return $this->belongsTo(User::class, 'invited_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
