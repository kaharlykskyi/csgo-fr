<?php

namespace App\Http\Controllers;

use App\{AppTreid\StreamApi, Comment, Match, Player, Team, User, Tournament, Stream};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchPageController extends Controller
{
    use StreamApi;

    public function index(Request $request){
        $match_data = Match::where('id', $request->id)->first();

        $team_json = json_decode($match_data->team);
        $team = (object)[
            'team1' => Team::where('id',$team_json->team_names1)->first(),
            'team2' => Team::where('id',$team_json->team_names2)->first(),
            'players_team1' => Player::where('team_id',$team_json->team_names1)->get(),
            'players_team2' => Player::where('team_id',$team_json->team_names2)->get()
        ];

        $countrys = DB::table('countrys')->get();
        $comments = Comment::where('match_id',$request->id)->paginate(20);
        $count = Comment::where('match_id',$request->id)->count();
        $users_id = [];
        $type_match = $request->type;
        foreach ($comments as $comment){
            $users_id[] = $comment->user_id;
        }
        $tournament = Tournament::where('id',$match_data->tournament)->first();
        $users = User::whereIn('id',$users_id)->get();
        $streams = Stream::where('show_homepage','on')->get();

        $streams_output = $this->getStream($streams);

        $latest_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->limit(20)->get();
        $live_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) IN (0,1,2)")->limit(10)->get();
        $upcoming_matches = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) > 2")->limit(10)->get();
        $teams = Team::all();

        return view('matches.index',compact(
                'match_data',
                'countrys',
                'comments',
                'streams_output',
                'count',
                'users',
                'type_match',
                'tournament',
                'team',
                'latest_match',
                'live_match',
                'upcoming_matches',
                'teams'
            )
        );
    }

    public function writeComment(Request $request){
        $data = $request->post();
        if(isset($data['user_id'])){
            $comment = new Comment();
            $comment->fill($data);
            $comment->save();
            return back();
        }
        return back()->with('status', 'You must be logged in');
    }
}
