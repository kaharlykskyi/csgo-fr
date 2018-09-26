<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, Match, Stream, Team, Tournament, TournamentComment, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TournamentPageController extends Controller
{
    use StreamApi, MatchSort;

    public function index(Request $request){
        $tournament = Tournament::where('id', $request->id)->first();
        $streams = Stream::where('show_homepage','on')->get();

        DB::table('tournaments')->where('id',$request->id)->increment('viewers_count');

        $count = TournamentComment::where('tournament_id',$request->id)->count();
        $comments = TournamentComment::with('children')
            ->where('tournament_id',$request->id)
            ->where('parent_comment', null)
            ->get();

        $users_id = [];
        foreach ($comments as $comment){
            $users_id[] = $comment->user_id;
            if (isset($comment->children)){
                foreach ($comment->children as $child){
                    $users_id[] = $child->user_id;
                }
            }
        }

        $streams_output = $this->getStream($streams);

        $teams = Team::all();

        $users = User::whereIn('id',$users_id)->get();
        return view('tournaments.index', compact(
            'tournament',
            'streams_output',
            'count',
            'users',
            'comments',
            'teams'
        ))->with(['sort_match' => $this->selectMatch()]);
    }

    public function writeComment(Request $request){
        $data = $request->post();
        if(isset($data['user_id'])){
            $comment = new TournamentComment();
            $data['tournament_id'] = $data['object_id'];
            $comment->fill($data);
            $comment->save();
            return back();
        }
        return back()->with('status', 'You must be logged in');
    }

    public function like(Request $request){
        $liked = DB::table('tournaments_likes')->where(['comment_id' => $request->id, 'user_id' => Auth::user()->id])->first();
        if (isset($liked)){
            return abort('407', 'You have liked this');
        }
        $comment = TournamentComment::where('id',$request->id)->first();
        $comment->like_count = (int)$comment->like_count + (int)$request->increment;
        DB::table('tournament_comments')->where('id',$request->id)->update([
            'like_count' => $comment->like_count
        ]);
        DB::table('tournaments_likes')->insert(['comment_id' => $request->id, 'user_id' => Auth::user()->id]);

        return $comment->like_count;
    }

    public function allTournaments(){
        $tournament = Tournament::orderByDesc('created_at')->paginate(30);

        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);
        $teams = Team::all();

        return view('tournaments.all_tournaments', compact('tournament','streams_output','teams'))->with(['sort_match' => $this->selectMatch()]);
    }
}
