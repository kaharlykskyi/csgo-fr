<?php

namespace App\Http\Controllers;

use App\{AppTreid\StreamApi, Match, Player, Stream, Team};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    use StreamApi;

    public function index(Request $request){
        $team = Team::where('name',$request->name)->first();
        $players = Player::where('team_id',$team->id)->get();
        $countrys = DB::table('countrys')->get();

        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);

        $team_latest_match = null;
        $latest_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->get();
        $count = 0;

        foreach ($latest_match as $match){
            $team_inf = json_decode($match->team);
            if($team_inf->team_names1 == $team->id || $team_inf->team_names2 == $team->id){
                $team_latest_match[] = (object)[
                    'team1' => Team::where('id',$team_inf->team_names1)->first(),
                    'team2' => Team::where('id',$team_inf->team_names2)->first(),
                    'match' => $match
                ];
                $count++;
            }
            if ($count == 15) break;
        }

        $history = DB::table('team_history')->where('team_id',$team->id)->get();

        $latest_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->limit(20)->get();
        $live_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) IN (0,1,2)")->limit(10)->get();
        $upcoming_matches = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) > 2")->limit(10)->get();
        $teams = Team::all();


        return view('team_page.index', compact(
            'team',
            'streams_output',
            'countrys',
            'players',
            'team_latest_match',
            'history',
            'latest_match',
            'live_match',
            'upcoming_matches',
            'teams'
        ));
    }
}
