<?php

namespace App\Http\Controllers;

use App\Stream;
use App\Tournament;
use Illuminate\Http\Request;

class TournamentPageController extends Controller
{
    public function index(Request $request){
        $tournament = Tournament::where('id', $request->id)->first();
        $streams = Stream::where('show_homepage','on')->get();
        return view('tournaments.index', compact('tournament', 'streams'));
    }
}
