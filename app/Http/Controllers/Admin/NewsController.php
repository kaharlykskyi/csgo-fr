<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(20);
        return view('admin_area.news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = NewsCategory::all();
        $countries = DB::table('countrys')->get();
        return view('admin_area.news.create',compact('countries','categories'));
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
            'title' => 'required',
            'content_news' => 'required',
            'banner_image' => 'required|file',
            'publication_date' => 'date_format:Y-m-d'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $data['banner_image'] = $file->getClientOriginalName();
            $file->move(public_path() . '/assets/images/news_img/',$data['banner_image']);
        }

        $data['user_id'] = Auth::user()->id;

        if ($data['category_id'] == 0){
            $data['category_id'] = null;
        }

        if(!isset($data['publication_date'])){
            $data['publication_date'] = date('Y-m-d');
        }

        $news = new News();
        $news->fill($data);
        if($news->save()){
            return redirect()->route('admin.news.index')->with('status','News Added');
        } else{
            dump($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin_area.news.view_news', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        $countries = DB::table('countrys')->get();
        return view('admin_area.news.edit',compact('countries','news','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $data = $request->except(['_token','_method']);

        if($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $data['banner_image'] = $file->getClientOriginalName();
            $file->move(public_path() . '/assets/images/news_img/',$data['banner_image']);
        }

        if(!isset($data['user_id'])){
            $data['user_id'] = Auth::user()->id;
        }

        if(!isset($data['publication_date'])){
            $data['publication_date'] = date('Y-m-d');
        }

        if ($data['category_id'] == 0){
            $data['category_id'] = null;
        }

        $news->update($data);

        if($news->save()){
            return redirect()->back()->with('status','News update');
        } else {
            return redirect()->back()->with('status','News not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index');
    }
}
