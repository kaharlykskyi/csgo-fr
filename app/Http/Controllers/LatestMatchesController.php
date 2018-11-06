<?php

namespace App\Http\Controllers;

use App\AppTreid\MatchSort;
use App\AppTreid\StreamApi;
use App\Match;
use App\Stream;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LatestMatchesController extends Controller
{
    use StreamApi,MatchSort;

    public function index(){
        $teams = Team::all();
        //stream part
        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);

        $count_latest_match = DB::table('settings')->where('name','=','count_latest_match')->first();
        $latest_match_notlimit = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->paginate($count_latest_match->value);

        return view('matches.latest_matches',
            compact(
                'streams_output',
                'teams',
                'latest_match_notlimit'
            )
        )->with(['sort_match' => $this->selectMatch()]);
    }
}
