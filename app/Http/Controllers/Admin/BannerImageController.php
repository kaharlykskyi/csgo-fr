<?php

namespace App\Http\Controllers\Admin;

use App\BannerImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BannerImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = BannerImage::paginate(40);

        return view('admin_area.home_content.banner_index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_area.home_content.banner_create');
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
            'img' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $image = new BannerImage();
        $image->fill($data);
        if($image->save()){
            return redirect()->route('admin.banner-image.index')->with('status','Image Added');
        } else{
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function show(BannerImage $bannerImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerImage $bannerImage)
    {
        return view('admin_area.home_content.banner_edit',compact('bannerImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerImage $bannerImage)
    {
        $data = $request->except('_token');

        $validate = Validator::make($data,[
            'img' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $bannerImage->update($data);
        if($bannerImage->save()){
            return redirect()->back()->with('status','Image Update');
        } else{
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BannerImage  $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerImage $bannerImage)
    {
        $bannerImage->delete();
        return back()->with('status','Image Deleted');
    }
}
