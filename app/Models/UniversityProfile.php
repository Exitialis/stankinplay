<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityProfile extends Model
{
    protected $fillable = ['last_name', 'first_name', 'middle_name', 'group_id', 'studentID', 'module', 'budget', 'grants'];

    protected $visible = ['last_name', 'first_name', 'middle_name', 'group_id', 'group', 'studentID', 'module', 'budget', 'grants'];

    /**
     * Группа в университете.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
