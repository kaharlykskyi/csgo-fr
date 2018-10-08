<?php
/**
 * Created by PhpStorm.
 * User: Seliv
 * Date: 08.10.2018
 * Time: 10:53
 */

namespace App\AppTreid;

use Illuminate\Support\Facades\DB;

trait ProfileInf
{
    public function getInfo(){
        $count_forum_topics_profile = DB::table('settings')->where('name','=','count_forum_topics_profile')->select('value')->first();
        $count_topic_posts_profile = DB::table('settings')->where('name','=','count_topic_posts_profile')->select('value')->first();
        $count_comments_profile = DB::table('settings')->where('name','=','count_comments_profile')->select('value')->first();

        $last_forum_mass = DB::table('thread_posts')
            ->join('topic_threads','thread_posts.thread_id', '=', 'topic_threads.id')
            ->join('forum_topics','topic_threads.topic_id', '=', 'forum_topics.id')
            ->select(['thread_posts.*','forum_topics.id as id_topic','topic_threads.id as id_thread'])
            ->where('topic_threads.state','!=',0)
            ->orderByDesc('created_at')
            ->limit((int)$count_topic_posts_profile->value)
            ->get();
        $last_forum_topic = DB::table('topic_threads')
            ->join('forum_topics','topic_threads.topic_id', '=', 'forum_topics.id')
            ->select(['topic_threads.*','forum_topics.id as id_topic'])
            ->orderByDesc('topic_threads.created_at')
            ->limit((int)$count_forum_topics_profile->value)
            ->get();

        $match_comments = DB::table('comments_match')->orderByDesc('created_at')->limit(10)->get();
        $news_comments = DB::table('news_comments')->orderByDesc('created_at')->limit(10)->get();
        $tournament_comments = DB::table('tournament_comments')->orderByDesc('created_at')->limit(10)->get();

        foreach ($match_comments as $comment){
            $comments [] = $comment;
        }
        foreach ($news_comments as $comment){
            $comments [] = $comment;
        }
        foreach ($tournament_comments as $comment){
            $comments [] = $comment;
        }

        if(isset($comments)){
            usort($comments, function($a,$b){
                return strcmp($b->created_at,$a->created_at);
            });

            $comments = array_slice($comments,0,(int)$count_comments_profile->value);
        }

        $info = (object)[
            'last_forum_mass' => $last_forum_mass,
            'last_forum_topic' => $last_forum_topic,
            'comments' => $comments
        ];

        return $info;
    }
}