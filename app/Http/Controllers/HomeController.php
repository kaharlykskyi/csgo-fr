<?php

namespace App\Http\Controllers;

use App\AppTreid\StreamApi;
use App\Match;
use App\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use StreamApi;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->limit(20)->get();
        $live_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) IN (0,1,2)")->limit(10)->get();
        $upcoming_matches = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) > 2")->limit(10)->get();
        $latest_news = DB::table('news')
            ->orderByDesc('created_at')
            ->limit(40)
            ->get();
        $latest_turnaments = DB::table('tournaments')
            ->orderByDesc('created_at')
            ->limit(40)
            ->get();
        $countrys = DB::table('countrys')->get();
        $streams = Stream::where('show_homepage','on')->get();

        $streams_output = $this->getStream($streams);

        return view('home.index',
            compact(
                'latest_news',
                'countrys',
                'latest_turnaments',
                'latest_match',
                'live_match',
                'upcoming_matches',
                'streams_output'
            )
        );
    }
}
