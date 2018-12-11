<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, News, NewsComment, Stream, Team, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewsPageController extends Controller
{
    use StreamApi, MatchSort;

    public function index(Request $request){
        if(isset(Auth::user()->id)){
            DB::table('comments_notification')->where([
                ['user_id',Auth::user()->id],
                ['resource_id',$request->id],
                ['link','news_page']
            ])->update(['seen' => 'true']);
        }
        $news = News::where('id', $request->id)->first();
        DB::table('news')->where('id',$news->id)->update(['viewers_count' => $news->viewers_count = (int)$news->viewers_count + 1]);
        $streams = Stream::where('show_homepage','on')->get();

        $count = NewsComment::where('news_id',$request->id)->count();
        $comments = NewsComment::with('children')
            ->where('news_id',$request->id)
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
        $users = User::whereIn('id',$users_id)->get();

        $streams_output = $this->getStream($streams);

        $teams = Team::all();

        return view('news.index', compact(
            'news',
            'streams_output',
            'count',
            'comments',
            'users',
            'teams'
        ))->with(['sort_match' => $this->selectMatch()]);
    }

    public function writeComment(Request $request){
        $data = $request->post();
        if(isset($data['user_id'])){
            $comment = new NewsComment();
            $data['news_id'] = $data['object_id'];
            $comment->fill($data);
            if($comment->save()){
                if (isset($comment->parent_comment)){
                    $parent_comment = DB::table('news_comments')->where('id',$comment->parent_comment)->first();

                    DB::table('comments_notification')->insert([
                        'user_id' => $parent_comment->user_id,
                        'link' => 'news_page',
                        'resource_id' => $comment->news_id,
                        'seen' => 'false',
                        'comment_id' => $comment->id,
                        'created_at' => \Illuminate\Support\Carbon::now(),
                        'updated_at' => \Illuminate\Support\Carbon::now()
                    ]);
                }
            }
            return back();
        }
        return back()->with('status', 'You must be logged in');
    }

    public function like(Request $request){
        $liked = DB::table('news_likes')->where(['comment_id' => $request->id, 'user_id' => Auth::user()->id])->first();
        if (isset($liked)){
            return abort('500', 'You already rated this comment');
        }
        $comment = NewsComment::where('id',$request->id)->first();
        $comment->like_count = (int)$comment->like_count + (int)$request->increment;
        DB::table('news_comments')->where('id',$request->id)->update([
            'like_count' => $comment->like_count
        ]);
        DB::table('news_likes')->insert(['comment_id' => $request->id, 'user_id' => Auth::user()->id]);

        return $comment->like_count;
    }

    public function allNews(){
        $count_news = DB::table('settings')->where('name','=','count_all_news')->first();;
        $news = News::where('enabled','on')->orderByDesc('created_at')->paginate($count_news->value);
        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);
        $teams = Team::all();
        return view('news.all_news', compact('news','streams_output','teams'))->with(['sort_match' => $this->selectMatch()]);
    }
}
