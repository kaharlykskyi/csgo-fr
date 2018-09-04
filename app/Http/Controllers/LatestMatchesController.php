<?php

namespace App\Http\Controllers;

use App\AppTreid\MatchSort;
use App\AppTreid\StreamApi;
use App\Match;
use App\Stream;
use App\Team;
use Illuminate\Http\Request;

class LatestMatchesController extends Controller
{
    use StreamApi,MatchSort;

    public function index(){
        $teams = Team::all();
        //stream part
        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);

        $latest_match_notlimit = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->paginate(30);

        return view('matches.latest_matches',
            compact(
                'streams_output',
                'teams',
                'latest_match_notlimit'
            )
        )->with(['sort_match' => $this->selectMatch()]);
    }
}
