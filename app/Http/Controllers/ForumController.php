<?php

namespace App\Http\Controllers;

use App\ForumCategory;
use App\ForumTopic;
use App\ThreadPost;
use App\TopicThread;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function index(){
        $topics = [];
        $category = ForumCategory::all();
        foreach ($category as $item){
            $category_id = $item->id;
            $topics[] = [
                'topics' => DB::table('forum_topics')
                    ->whereIn('id', function ($query) use ($category_id) {
                        $query->select('topic_id')
                            ->from('forum_category_relation')
                            ->where('category_id', $category_id);
                    })
                    ->get(),
                'category' => $item
            ];
        }
        return view('forum.index',compact('topics','category'));
    }

    public function topicPage(Request $request){
        $topic = ForumTopic::where('id',$request->id)->first();
        $threads = TopicThread::where(['topic_id' => $topic->id])->whereIn('state',[0,1])->orderBy('created_at', 'desc')->paginate(25);
        $affix_threads = TopicThread::where('topic_id',$topic->id)->whereIn('state',[2])->orderBy('created_at', 'desc')->limit(3)->get();
        $users_id = [];
        foreach ($threads as $thread){
            $users_id[] = $thread->user_id;
        }
        foreach ($affix_threads as $affix_thread){
            $users_id[] = $affix_thread->user_id;
        }

        $users = User::whereIn('id',$users_id)->get();
        return view('forum.topic_page',compact('topic','threads','users','affix_threads'));
    }

    public function createThread(Request $request){
        if ($request->isMethod('post')){
            $data = $request->except('_token');

            $validate = Validator::make($data,[
                'title' => 'required|unique:topic_threads',
                'topic_id' => 'required'
            ]);

            if ($validate->fails()) {
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }

            $data['user_id'] = Auth::user()->id;

            $data['state'] = 1;

            $thread = new TopicThread();
            $thread->fill($data);

            if($thread->save()){
                $post_data = [
                    'text_post' => $thread->description,
                    'thread_id' => $thread->id,
                    'user_id' => $thread->user_id,
                    'sequence_number' => 0
                ];
                $post = new ThreadPost();
                $post->fill($post_data);
                $post->save();
                return redirect()->route('topic_page',$request->topic_id)->with('status','Thread created');
            } else{
                return redirect()->back()->withInput()->with('status','Thread not created');
            }
        }

        $topic_id = $request->id_topic;
        return view('forum.create_thread', compact('topic_id'));
    }

    public function threadPost(Request $request){
        $topic = ForumTopic::where('id',$request->id)->first();
        $thread = TopicThread::where('id',$request->thread_id)->first();
        $posts = ThreadPost::with('children')->where('parent_post', null)->where('thread_id',$thread->id)->paginate(20);
        $users_id = [];
        foreach ($posts as $post){
            $users_id[] = $post->user_id;
            if (isset($post->children)){
                foreach ($post->children as $child){
                    $users_id[] = $child->user_id;
                }
            }
        }
        $users = User::whereIn('id',$users_id)->get();
        return view('forum.thread_post', compact('thread','topic','posts','users'));
    }

    public function createPost(Request $request){
        $data = $request->except('_token');

        $validate = Validator::make($data,[
            'text_post' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if (isset($data['edit_id_post'])){
            DB::table('thread_posts')->where('id', $data['edit_id_post'])
                ->where('user_id', Auth::user()->id)
                ->update([
                    'text_post' => $data['text_post'],
                    'edit' => 'true',
                    'updated_at' => Carbon::now()
                ]);

            return back();
        }

        $post = ThreadPost::where('thread_id',(integer)$data['thread_id'])->latest()->first();
        $data['sequence_number'] = (int)$post->sequence_number + 1;
        $data['user_id'] = Auth::user()->id;

        $post = new ThreadPost();
        $post->fill($data);
        $post->save();
        return redirect()->back();
    }

    public function threadAction(Request $request){
        switch ($request->action){
            case 'unpick':
                DB::table('topic_threads')->where('id',$request->id)->update(['state' => 1]);
                return redirect()->back()->with('status','Thread unpick');
                break;
            case 'pick':
                DB::table('topic_threads')->where('id',$request->id)->update(['state' => 2]);
                return redirect()->back()->with('status','Thread pick');
                break;
            case 'lock':
                DB::table('topic_threads')->where('id',$request->id)->update(['state' => 0]);
                return redirect()->back()->with('status','Thread lock');
                break;
            case 'unlock':
                DB::table('topic_threads')->where('id',$request->id)->update(['state' => 1]);
                return redirect()->back()->with('status','Thread unlock');
                break;
            case 'delete':
                DB::table('topic_threads')->where('id',$request->id)->delete();
                return redirect()->back()->with('status','Thread deleted');
                break;
            default:
                return redirect()->back();
        }

    }

    public function postDelete(Request $request){
        DB::table('thread_posts')->where('id',$request->id)->delete();
        return redirect()->back()->with('status','Post deleted');
    }
}
