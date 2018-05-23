<?php

namespace App\Http\Controllers\Api\User\Profiles;

use App\Models\Statistics;
use App\Http\Controllers\Controller;

class GameProfilesController extends Controller
{
    public function get($userId)
    {
        $stats = Statistics::where('user_id', $userId)->first()->stats;

        return response()->json([
            'kills' => $stats->kills,
            'deaths' => $stats->deaths,
            'killsChanges' => $stats->killChanges,
            'rank' => $stats->rank_title,
            'winChanges' => $stats->winChanges,
            'headshots' => $stats->hsp,
            'kdr' => $stats->kdr,
            'kdrChanges' => $stats->kdrChanges,
            'winRate' => $stats->winRate,
            'accuracy' => $stats->accuracy,
            'headshotsChanges' => $stats->hsChanges,
            'accuracyChanges' => $stats->accChanges
        ]);
    }
}
