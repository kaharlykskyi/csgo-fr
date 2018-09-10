<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::paginate(40);
        $galleres = Gallery::all();
        return view('admin_area.image.index', compact('images','galleres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $galleres = Gallery::all();
        return view('admin_area.image.create', compact('galleres'));
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
            'path' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if ($data['gallery_id'] == 0){
            $data['gallery_id'] = null;
        }

        $image = new Image();
        $image->fill($data);
        if($image->save()){
            return redirect()->route('admin.image.index')->with('status','Image Added');
        } else{
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        $galleres = Gallery::all();
        return view('admin_area.image.edit', compact('image','galleres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        $data = $request->except('_token');

        $validate = Validator::make($data,[
            'path' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if ($data['gallery_id'] == 0){
            $data['gallery_id'] = null;
        }

        $image->update($data);
        if($image->save()){
            return redirect()->back()->with('status','Image Added');
        } else{
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return back()->with('status','Image Deleted');
    }
}
