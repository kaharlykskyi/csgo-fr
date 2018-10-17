<?php

namespace App\Http\Controllers\Admin;

use App\ForumCategory;
use App\ForumTopic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ForumCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = ForumCategory::orderByDesc('created_at')->paginate(20);
        return view('admin_area.forum_category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_area.forum_category.create');
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
            'title' => 'required|unique:forum_category',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $category = new ForumCategory();
        $category->fill($data);

        if($category->save()){
            return redirect()->route('admin.forum-category.index')->with('status','Category Added');
        } else{
            return redirect()->route('admin.forum-category.index')->with('status','Category not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ForumCategory  $forumCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ForumCategory $forumCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ForumCategory  $forumCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumCategory $forumCategory)
    {
        return view('admin_area.forum_category.edit',compact('forumCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ForumCategory  $forumCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ForumCategory $forumCategory)
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

        $forumCategory->update($data);

        if($forumCategory->save()){
            return redirect()->back()->with('status','Category Update');
        } else{
            return redirect()->back()->with('status','Category Not Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ForumCategory  $forumCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ForumCategory $forumCategory)
    {
        $forumCategory->delete();
        return redirect()->back()->with('status','Category delete');
    }
}
