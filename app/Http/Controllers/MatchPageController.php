<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Match;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchPageController extends Controller
{
    public function index(Request $request){
        $match_data = Match::where('id', $request->id)->first();
        $countrys = DB::table('countrys')->get();
        $comments = Comment::where('match_id',$request->id)->paginate(20);
        $count = Comment::where('match_id',$request->id)->count();
        $users = User::all();
        return view('matches.index',compact('match_data','countrys','comments','count','users'));
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
