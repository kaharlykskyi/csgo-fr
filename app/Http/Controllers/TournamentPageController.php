<?php

namespace App\Http\Controllers;

use App\{AppTreid\StreamApi, Match, Stream, Team, Tournament, TournamentComment, User};
use Illuminate\Http\Request;

class TournamentPageController extends Controller
{
    use StreamApi;

    public function index(Request $request){
        $tournament = Tournament::where('id', $request->id)->first();
        $streams = Stream::where('show_homepage','on')->get();
        $count = TournamentComment::where('tournament_id',$request->id)->count();
        $comments = TournamentComment::where('tournament_id',$request->id)->paginate(20);
        $users_id = [];
        foreach ($comments as $comment){
            $users_id[] = $comment->user_id;
        }

        $streams_output = $this->getStream($streams);

        $latest_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->limit(20)->get();
        $live_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) IN (0,1,2)")->limit(10)->get();
        $upcoming_matches = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) > 2")->limit(10)->get();
        $teams = Team::all();

        $users = User::whereIn('id',$users_id)->get();
        return view('tournaments.index', compact(
            'tournament',
            'streams_output',
            'count',
            'users',
            'comments',
            'latest_match',
            'live_match',
            'upcoming_matches',
            'teams'
        ));
    }

    public function writeComment(Request $request){
        $data = $request->post();
        if(isset($data['user_id'])){
            $comment = new TournamentComment();
            $comment->fill($data);
            $comment->save();
            return back();
        }
        return back()->with('status', 'You must be logged in');
    }
}
