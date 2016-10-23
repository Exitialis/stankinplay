<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SteamProfile
 *
 * @property integer $id
 * @property string $steam_id
 * @property integer $steam64_id
 * @property string $name
 * @property string $profile_url
 * @property string $avatar
 * @property string $realname
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereSteamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereSteam64Id($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereProfileUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereRealname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SteamProfile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SteamProfile extends Model
{
    //
}
