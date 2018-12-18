<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, BannerImage, News, NewsCategory, Stream, Team};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    use StreamApi, MatchSort;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_news_home = DB::table('settings')->where('name','=','count_news_home')->select('value')->first();
        $count_tournaments_home = DB::table('settings')->where('name','=','count_tournaments_home')->select('value')->first();
        $teams = Team::all();
        $latest_news = DB::table('news')
            ->orderByDesc('created_at')
            ->limit((int)$count_news_home->value)
            ->get();
        $latest_turnaments = DB::table('tournaments')
            ->orderByDesc('created_at')
            ->limit((int)$count_tournaments_home->value)
            ->get();
        $countrys = DB::table('countrys')->get();

        //stream part
        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);

        //news tabbed
        $news_categories = NewsCategory::all();
        $news_tabbed = null;
        $count_news_tabbed = DB::table('settings')->where('name','=','count_news_tabbed')->first();
        foreach ($news_categories as $news_category){
            $news_tabbed [] = (object)[
                'category' => $news_category->name,
                'news' => News::where('category_id',$news_category->id)->where('enabled','=','on')
                    ->limit($count_news_tabbed->value)
                    ->get()
            ];
        }

        $announcement = null;
        $exists = Storage::disk()->exists('announcement.txt');
        if ($exists){
            $announcement = Storage::get('announcement.txt');
        }

        $banner = BannerImage::all();

        return view('home.index',
            compact(
                'latest_news',
                'countrys',
                'latest_turnaments',
                'streams_output',
                'teams',
                'news_tabbed',
                'sort_match',
                'announcement',
                'banner'
            )
        )->with(['sort_match' => $this->selectMatch()]);
    }

    public function deleteComment(Request $request){
        switch ($request->link){
            case 'match_page':
                $user = DB::table('comments_match')
                    ->where('comments_match.id', $request->id)
                    ->join('users','users.id','=','comments_match.user_id')
                    ->select('users.moderators')->first();

                if($user->moderators !== 'super_admin' || Auth::user()->moderators === 'super_admin'){
                    DB::table('comments_match')->where('id', $request->id)->delete();
                }
                break;
            case 'news_page':
                $user = DB::table('news_comments')
                    ->where('news_comments.id', $request->id)
                    ->join('users','users.id','=','news_comments.user_id')
                    ->select('users.moderators')->first();

                if($user->moderators !== 'super_admin' || Auth::user()->moderators === 'super_admin'){
                    DB::table('news_comments')->where('id', $request->id)->delete();
                }
                break;
            case 'tournament_page':
                $user = DB::table('tournament_comments')
                    ->where('news_comments.id', $request->id)
                    ->join('users','users.id','=','tournament_comments.user_id')
                    ->select('users.moderators')->first();

                if($user->moderators !== 'super_admin' || Auth::user()->moderators === 'super_admin') {
                    DB::table('tournament_comments')->where('id', $request->id)->delete();
                }
                break;
            default:
                return back();
        }

        return back();
    }

    public function editComment(Request $request){
        $data = $request->post();
        switch ($data['type_page']){
            case 'match_page':
                $comment = DB::table('comments_match')->where('comments_match.id',$data['id_comment'])
                    ->join('users','users.id','=','comments_match.user_id')
                    ->select('users.moderators','comments_match.*')->first();;

                if($comment->user_id === $data['user_id'] || ((Auth::user()->moderators === 'super_admin' || Auth::user()->moderators === 'admin') && $comment->moderators !== 'super_admin') ){
                    DB::table('comments_match')
                        ->where('id',$data['id_comment'])->update([
                            'comment' => $data['comment'],
                            'moder_id' => Auth::user()->id,
                            'updated_at' => Carbon::now()
                        ]);
                }
                break;
            case 'news_page':
                $comment = DB::table('news_comments')->where('news_comments.id',$data['id_comment'])
                    ->join('users','users.id','=','news_comments.user_id')
                    ->select('users.moderators','news_comments.*')->first();

                if($comment->user_id === $data['user_id'] || ((Auth::user()->moderators === 'super_admin' || Auth::user()->moderators === 'admin') && $comment->moderators !== 'super_admin') ){
                    DB::table('news_comments')
                        ->where('id',$data['id_comment'])->update([
                            'comment' => $data['comment'],
                            'moder_id' => Auth::user()->id,
                            'updated_at' => Carbon::now()
                        ]);
                }

                break;
            case 'tournament_page':
                $comment = DB::table('tournament_comments')->where('tournament_comments.id',$data['id_comment'])
                    ->join('users','users.id','=','tournament_comments.user_id')
                    ->select('users.moderators','tournament_comments.*')->first();
                if($comment->user_id === $data['user_id'] || ((Auth::user()->moderators === 'super_admin' || Auth::user()->moderators === 'admin') && $comment->moderators !== 'super_admin') ){
                    DB::table('tournament_comments')
                        ->where('id',$data['id_comment'])->update([
                            'comment' => $data['comment'],
                            'moder_id' => Auth::user()->id,
                            'updated_at' => Carbon::now()
                        ]);
                }
                break;
        }

        return back();
    }

    public function moderStatusComment(Request $request){
        switch ($request->type){
            case 'match_page':
                $comment = DB::table('comments_match')->where('comments_match.id',$request->id)
                    ->join('users','users.id','=','comments_match.user_id')
                    ->select('users.moderators','comments_match.*')->first();

                if(Auth::user()->moderators === 'super_admin' || ( Auth::user()->moderators === 'admin' && $comment->moderators !== 'super_admin')){
                    DB::table('comments_match')
                        ->where('id',$request->id)->update([
                            'moder' => ($comment->moder === 'true') ? 'false': 'true'
                        ]);
                }
                break;
            case 'news_page':
                $comment = DB::table('news_comments')->where('news_comments.id',$request->id)
                    ->join('users','users.id','=','news_comments.user_id')
                    ->select('users.moderators','news_comments.*')->first();

                if(Auth::user()->moderators === 'super_admin' || ( Auth::user()->moderators === 'admin' && $comment->moderators !== 'super_admin')){
                    DB::table('news_comments')
                        ->where('id',$request->id)->update([
                            'moder' => ($comment->moder === 'true') ? 'false': 'true'
                        ]);
                }

                break;
            case 'tournament_page':
                $comment = DB::table('tournament_comments')->where('tournament_comments.id',$request->id)
                    ->join('users','users.id','=','tournament_comments.user_id')
                    ->select('users.moderators','tournament_comments.*')->first();

                if(Auth::user()->moderators === 'super_admin' || ( Auth::user()->moderators === 'admin' && $comment->moderators !== 'super_admin')){
                    DB::table('tournament_comments')
                        ->where('id',$request->id)->update([
                            'moder' => ($comment->moder === 'true') ? 'false': 'true'
                        ]);
                }
                break;
        }
    }
}
