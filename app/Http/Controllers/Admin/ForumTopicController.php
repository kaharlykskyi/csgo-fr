<?php

namespace App\Http\Controllers\Admin;

use App\ForumCategory;
use App\ForumTopic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ForumTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = ForumTopic::orderByDesc('created_at')->paginate(20);
        return view('admin_area.forum_topic.index',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forum_category = ForumCategory::all();
        return view('admin_area.forum_topic.create',compact('forum_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $validate = Validator::make($data,[
            'title' => 'required|unique:forum_topics',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $data['user_id'] = Auth::user()->id;

        $topic = new ForumTopic();
        $topic->fill($data);

        if($topic->save()){
            if ($data['forum_category']){
                foreach ($data['forum_category'] as $val){
                    DB::table('forum_category_relation')->insert([
                        'category_id' => $val,
                        'topic_id' => $topic->id
                    ]);
                }
            }
            return redirect()->route('admin.forum-topic.edit',$topic->id)->with('status','Topic Added');
        } else{
            return redirect()->route('admin.forum-topic.index')->with('status','Topic not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ForumTopic  $forumTopic
     * @return \Illuminate\Http\Response
     */
    public function show(ForumTopic $forumTopic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ForumTopic  $forumTopic
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumTopic $forumTopic)
    {
        $forum_category = ForumCategory::all();
        $use_forum_category = DB::table('forum_category_relation')->where('topic_id',$forumTopic->id)->get();
        return view('admin_area.forum_topic.edit', compact('forumTopic','forum_category','use_forum_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ForumTopic  $forumTopic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ForumTopic $forumTopic)
    {
        $data = $request->except('_token');

        $validate = Validator::make($data,[
            'title' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $forumTopic->update($data);

        if($forumTopic->save()){
            $use_forum_category = DB::table('forum_category_relation')->where('topic_id',$forumTopic->id)->get();
            $id_use_forum_cat = [];
            foreach ($use_forum_category as $value){
                $id_use_forum_cat[] = $value->category_id;
                if (array_search($value->category_id,$data['forum_category']) === false){
                    DB::table('forum_category_relation')->where([
                        'category_id' => $value->category_id,
                        'topic_id' => $forumTopic->id
                    ])->delete();
                }
            }
            foreach ($data['forum_category'] as $value){
                if (array_search($value,$id_use_forum_cat) === false){
                    DB::table('forum_category_relation')->insert([
                        'category_id' => $value,
                        'topic_id' => $forumTopic->id
                    ]);
                }
            }
            return redirect()->back()->with('status','Topic Added');
        } else{
            return redirect()->back()->with('status','Topic Not Added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ForumTopic  $forumTopic
     * @return \Illuminate\Http\Response
     */
    public function destroy(ForumTopic $forumTopic)
    {
        $forumTopic->delete();
        return redirect()->back();
    }
}
