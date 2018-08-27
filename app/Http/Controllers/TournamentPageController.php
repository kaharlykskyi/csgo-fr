<?php

namespace App\Http\Controllers;

use App\{Stream,Tournament,TournamentComment,User};
use Illuminate\Http\Request;

class TournamentPageController extends Controller
{
    public function index(Request $request){
        $tournament = Tournament::where('id', $request->id)->first();
        $streams = Stream::where('show_homepage','on')->get();
        $count = TournamentComment::where('tournament_id',$request->id)->count();
        $comments = TournamentComment::where('tournament_id',$request->id)->paginate(20);
        $users_id = [];
        foreach ($comments as $comment){
            $users_id[] = $comment->user_id;
        }
        $users = User::whereIn('id',$users_id)->get();
        return view('tournaments.index', compact('tournament', 'streams','count','users','comments'));
    }

    public function writeComment(Request $request){
        $data = $request->post();
        if(isset($data['user_id'])){
            $comment = new TournamentComment();
            $comment->fill($data);
            $comment->save();
            return back();
        }
        return back()->with('status', 'You must be login');
    }
}
