<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, BannerImage, News, NewsCategory, Stream, Team};
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
        foreach ($news_categories as $news_category){
            $news_tabbed [] = (object)[
                'category' => $news_category->name,
                'news' => News::where('category_id',$news_category->id)->where('enabled','=','on')->limit(11)->get()
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
}
