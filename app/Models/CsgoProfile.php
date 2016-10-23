<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CsgoProfile
 *
 * @property integer $id
 * @property integer $kills
 * @property integer $deaths
 * @property integer $time_played
 * @property integer $wins
 * @property integer $kills_headshot
 * @property integer $shots_fired
 * @property integer $shots_hit
 * @property integer $mvps
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereKills($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereDeaths($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereTimePlayed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereWins($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereKillsHeadshot($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereShotsFired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereShotsHit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereMvps($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CsgoProfile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CsgoProfile extends Model
{
    //
}
