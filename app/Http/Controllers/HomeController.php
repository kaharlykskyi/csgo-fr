<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, BannerImage, News, NewsCategory, Stream, Team};
use Illuminate\Http\Request;
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
                DB::table('comments_match')->where('id', $request->id)->delete();
                break;
            case 'news_page':
                DB::table('news_comments')->where('id', $request->id)->delete();
                break;
            case 'tournament_page':
                DB::table('tournament_comments')->where('id', $request->id)->delete();
                break;
        }

        return back();
    }

    public function editComment(Request $request){
        $data = $request->post();
        switch ($data['type_page']){
            case 'match_page':
                DB::table('comments_match')->where([
                    ['id',$data['id_comment']],
                    ['user_id', $data['user_id']]
                ])->update(['comment' => $data['comment']]);
                break;
            case 'news_page':
                DB::table('news_comments')->where([
                    ['id',$data['id_comment']],
                    ['user_id', $data['user_id']]
                ])->update(['comment' => $data['comment']]);
                break;
            case 'tournament_page':
                DB::table('tournament_comments')->where([
                    ['id',$data['id_comment']],
                    ['user_id', $data['user_id']]
                ])->update(['comment' => $data['comment']]);
                break;
        }

        return back();
    }
}
