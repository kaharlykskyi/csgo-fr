<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, Match, Player, Stream, Team};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    use StreamApi, MatchSort;

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
            if (isset($team_inf)){
                if($team_inf->team_names1 == $team->id || $team_inf->team_names2 == $team->id){
                    $team_latest_match[] = (object)[
                        'team1' => Team::where('id',$team_inf->team_names1)->first(),
                        'team2' => Team::where('id',$team_inf->team_names2)->first(),
                        'match' => $match
                    ];
                    $count++;
                }
            }
            if ($count == 15) break;
        }

        $history = DB::table('team_history')->where('team_id',$team->id)->orderByDesc('created_at')->get();

        $teams = Team::all();


        return view('team_page.index', compact(
            'team',
            'streams_output',
            'countrys',
            'players',
            'team_latest_match',
            'history',
            'teams'
        ))->with(['sort_match' => $this->selectMatch()]);
    }
}
