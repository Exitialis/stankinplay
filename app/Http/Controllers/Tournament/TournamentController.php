<?php

namespace App\Http\Controllers\Tournament;

use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TournamentController extends Controller
{


    public function get()
    {
        $tournament = Tournament::get();
        return response()->json(compact('tournament'));
    }



}
