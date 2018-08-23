<?php

namespace App\Http\Controllers;

use App\{Comment,Match,User,Tournament,Stream};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchPageController extends Controller
{
    public function index(Request $request){
        $match_data = Match::where('id', $request->id)->first();
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
        return view('matches.index',compact(
                'match_data',
                'countrys',
                'comments',
                'streams',
                'count',
                'users',
                'type_match',
                'tournament'
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
        return back()->with('status', 'You must be login');
    }
}
