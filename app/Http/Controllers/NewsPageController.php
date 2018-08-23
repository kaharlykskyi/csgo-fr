<?php

namespace App\Http\Controllers;

use App\{News,Stream};
use Illuminate\Http\Request;

class NewsPageController extends Controller
{
    public function index(Request $request){
        $news = News::where('id', $request->id)->first();
        $streams = Stream::where('show_homepage','on')->get();
        return view('news.index', compact('news', 'streams'));
    }
}
