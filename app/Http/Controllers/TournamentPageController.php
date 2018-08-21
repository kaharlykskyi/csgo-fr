<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Http\Request;

class TournamentPageController extends Controller
{
    public function index(Request $request){
        $tournament = Tournament::where('id', $request->id)->first();
        return view('tournaments.index', compact('tournament'));
    }
}
