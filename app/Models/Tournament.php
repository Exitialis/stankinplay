<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tournament
 *
 * @property integer $id
 * @property string $name
 * @property integer $challonge_id
 * @property integer $discipline_id
 * @property string $live_image_url
 * @property string $full_challonge_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tournament whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tournament whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tournament whereChallongeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tournament whereDisciplineId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tournament whereLiveImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tournament whereFullChallongeUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tournament whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tournament whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tournament extends Model
{

}
