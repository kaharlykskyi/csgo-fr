<?php

namespace App\Http\Controllers;

use App\{News, NewsComment, Stream, User};
use Illuminate\Http\Request;

class NewsPageController extends Controller
{
    public function index(Request $request){
        $news = News::where('id', $request->id)->first();
        $streams = Stream::where('show_homepage','on')->get();
        $count = NewsComment::where('news_id',$request->id)->count();
        $comments = NewsComment::where('news_id',$request->id)->paginate(20);
        $users_id = [];
        foreach ($comments as $comment){
            $users_id[] = $comment->user_id;
        }
        $users = User::whereIn('id',$users_id)->get();
        return view('news.index', compact('news', 'streams','count','comments','users'));
    }

    public function writeComment(Request $request){
        $data = $request->post();
        if(isset($data['user_id'])){
            $comment = new NewsComment();
            $comment->fill($data);
            $comment->save();
            return back();
        }
        return back()->with('status', 'You must be login');
    }
}
