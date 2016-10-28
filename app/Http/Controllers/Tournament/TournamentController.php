<?php

namespace App\Http\Controllers\\Tournament;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TournamentController extends Controller
{


    public function get()
    {
        $live_image_url = Tournament::get();

        return response()->json(compact('team'));
    }



}
