<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, Match, Player, Stream, Team};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    use StreamApi, MatchSort;

    public function index(Request $request){
        $player = Player::where('nickname',$request->nickname)->first();
        $team = Team::where('id',$player->team_id)->first();
        $team_players = Player::where('team_id',$team->id)->get();
        $countrys = DB::table('countrys')->get();

        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);

        $player_latest_match = null;
        $latest_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->get();
        $count = 0;
        foreach ($latest_match as $match){
            $team_inf = json_decode($match->team);
            if (isset($team_inf)){
                if($team_inf->team_names1 == $team->id || $team_inf->team_names2 == $team->id){
                    $player_latest_match[] = (object)[
                        'team1' => Team::where('id',$team_inf->team_names1 )->first(),
                        'team2' => Team::where('id',$team_inf->team_names2)->first(),
                        'match' => $match
                    ];
                    $count++;
                }
            }
            if ($count == 15) break;
        }

        $teams = Team::all();

        return view('player_page.index', compact(
            'player',
            'team',
            'countrys',
            'streams_output',
            'team_players',
            'player_latest_match',
            'teams'
        ))->with(['sort_match' => $this->selectMatch()]);
    }
}
