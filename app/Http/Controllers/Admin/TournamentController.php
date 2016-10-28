<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::get();

        return view('admin.tournament.index', compact('tournaments'));
    }
}
