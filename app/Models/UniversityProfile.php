<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UniversityProfile
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $group_id
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property integer $studentID
 * @property boolean $module
 * @property boolean $budget
 * @property boolean $grants
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Group $group
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereMiddleName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereStudentID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereModule($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereBudget($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereGrants($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UniversityProfile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UniversityProfile extends Model
{
    
    protected $fillable = ['user_id', 'group_id', 'studentID', 'module', 'budget', 'grants', 'anotherSections', 'gto', 'socialActivity'];

    protected $visible = ['group_id', 'group', 'group_id', 'studentID', 'module', 'budget', 'grants', 'anotherSections', 'gto', 'socialActivity'];

    protected $casts = [
        'module' => 'boolean'
    ];

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
