<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsPageController extends Controller
{
    public function index(Request $request){
        $news = News::where('id', $request->id)->first();
        return view('news.index', compact('news'));
    }
}
