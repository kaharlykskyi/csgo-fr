<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort,AppTreid\StreamApi,News,NewsCategory,Stream,Team};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $teams = Team::all();
        $latest_news = DB::table('news')
            ->orderByDesc('created_at')
            ->limit(40)
            ->get();
        $latest_turnaments = DB::table('tournaments')
            ->orderByDesc('created_at')
            ->limit(40)
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
                'news' => News::where('category_id',$news_category->id)->where('enabled','=','on')->get()
            ];
        }

        return view('home.index',
            compact(
                'latest_news',
                'countrys',
                'latest_turnaments',
                'streams_output',
                'teams',
                'news_tabbed',
                'sort_match'
            )
        )->with(['sort_match' => $this->selectMatch()]);
    }
}
