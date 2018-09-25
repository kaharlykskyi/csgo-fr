<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request){
        $search = trim($request->search);
        $news = DB::table('news')
            ->where('title','like',"%{$search}%")
            ->orWhere('content_news','like',"%{$search}%")
            ->orWhere('author_name','like',"%{$search}%")
            ->orderByDesc('publication_date')->get();
        $tournaments = DB::table('tournaments')
            ->where('title','like',"%{$search}%")
            ->orWhere('content_tournament','like',"%{$search}%")
            ->orWhere('author','like',"%{$search}%")
            ->orderByDesc('publication_date')->get();
        $forum_topics = DB::table('forum_topics')
            ->where('title','like',"%{$search}%")
            ->orWhere('description','like',"%{$search}%")
            ->orderByDesc('created_at')->get();
        $topic_threads = DB::table('topic_threads')
            ->where('topic_threads.title','like',"%{$search}%")
            ->join('forum_topics','topic_threads.topic_id', '=', 'forum_topics.id')
            ->select(['topic_threads.*','forum_topics.id as id_topic'])
            ->orderByDesc('topic_threads.created_at')->get();
        $thread_posts = DB::table('thread_posts')
            ->where('text_post','like',"%{$search}%")
            ->orderByDesc('created_at')->get();
        $pageTitle = 'SEARCH';
        return view('search.index',compact(
            'pageTitle',
            'news',
            'search',
            'tournaments',
            'forum_topics',
            'topic_threads',
            'thread_posts'
        ));
    }
}
