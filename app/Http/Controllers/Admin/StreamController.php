<?php

namespace App\Http\Controllers\Admin;

use App\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $streams = Stream::paginate(20);
        return view('admin_area.streams.index', compact('streams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = DB::table('countrys')->get();
        return view('admin_area.streams.create', compact('countries'));
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
            'name' => 'required',
            'link' => 'required|url'
        ]);

        if ($validate->fails()) {
            return redirect()->route('admin.streams.create')
                ->withErrors($validate)
                ->withInput();
        }

        if(!isset($data['show_homepage'])){
            $data['show_homepage'] = 'off';
        }

        $stream = new Stream();
        $stream->fill($data);
        if($stream->save()){
            return redirect()->route('admin.streams.index')->with('status','Stream Added');
        } else{
            dump($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function show(Stream $stream)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function edit(Stream $stream)
    {
        $countries = DB::table('countrys')->get();
        return view('admin_area.streams.edit', compact('stream', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stream $stream)
    {
        $data = $request->except('_token');

        $validate = Validator::make($data,[
            'name' => 'required',
            'link' => 'required|url'
        ]);

        if ($validate->fails()) {
            return redirect()->route('admin.streams.create')
                ->withErrors($validate)
                ->withInput();
        }

        if(!isset($data['show_homepage'])){
            $data['show_homepage'] = 'off';
        }

        $stream->update($data);

        if($stream->save()){
            return redirect()->route('admin.streams.edit',$stream->id)->with('status','Stream update');
        } else {
            return redirect()->route('admin.streams.edit',$stream->id)->with('status','Stream not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stream $stream)
    {
        $stream->delete();
        return redirect()->route('admin.streams.index');
    }
}
