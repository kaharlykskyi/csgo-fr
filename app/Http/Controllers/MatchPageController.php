<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, Comment, Match, Player, Team, User, Tournament, Stream};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatchPageController extends Controller
{
    use StreamApi, MatchSort;

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

        $comments = Comment::with('children')
            ->where('match_id',$request->id)
            ->where('parent_comment', null)
            ->get();
        $count = Comment::where('match_id',$request->id)->count();

        $users_id = [];
        $type_match = $request->type;
        foreach ($comments as $comment){
            $users_id[] = $comment->user_id;
            if (isset($comment->children)){
                foreach ($comment->children as $child){
                    $users_id[] = $child->user_id;
                }
            }
        }
        $tournament = Tournament::where('id',$match_data->tournament)->first();
        $users = User::whereIn('id',$users_id)->get();
        $streams = Stream::where('show_homepage','on')->get();

        $streams_output = $this->getStream($streams);

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
                'teams'
            )
        )->with(['sort_match' => $this->selectMatch()]);
    }

    public function writeComment(Request $request){
        $data = $request->post();
        if(isset($data['user_id'])){
            $comment = new Comment();
            $data['match_id'] = $data['object_id'];
            $comment->fill($data);
            $comment->save();
            return back();
        }
        return back()->with('status', 'You must be logged in');
    }

    public function like(Request $request){
        $liked = DB::table('match_likes')->where(['comment_id' => $request->id, 'user_id' => Auth::user()->id])->first();
        if (isset($liked)){
            return abort('407', 'You have liked this');
        }
        $comment = Comment::where('id',$request->id)->first();
        $comment->like_count = (int)$comment->like_count + (int)$request->increment;
        DB::table('comments_match')->where('id',$request->id)->update([
            'like_count' => $comment->like_count
        ]);
        DB::table('match_likes')->insert(['comment_id' => $request->id, 'user_id' => Auth::user()->id]);

        return $comment->like_count;
    }
}
