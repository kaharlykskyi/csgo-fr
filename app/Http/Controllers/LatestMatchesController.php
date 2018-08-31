<?php

namespace App\Http\Controllers;

use App\AppTreid\StreamApi;
use App\Match;
use App\Stream;
use App\Team;
use Illuminate\Http\Request;

class LatestMatchesController extends Controller
{
    use StreamApi;

    public function index(){
        $latest_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->limit(20)->get();
        $live_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) IN (0,1,2)")->limit(10)->get();
        $upcoming_matches = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) > 2")->limit(10)->get();
        $teams = Team::all();
        //stream part
        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);

        $latest_match_notlimit = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->paginate(30);

        return view('matches.latest_matches',
            compact(
                'latest_match',
                'live_match',
                'upcoming_matches',
                'streams_output',
                'teams',
                'latest_match_notlimit'
            )
        );
    }
}
