<?php

namespace App\Http\Controllers\Admin;

use App\MatchMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MatchMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = MatchMap::orderByDesc('created_at')->paginate(40);
        return view('admin_area.match_map.index',compact('maps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_area.match_map.create');
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
            'title' => 'required|unique:match_maps',
            'path' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $map = new MatchMap();
        $map->fill($data);
        if ($map->save()){
            return redirect()->route('admin.match-map.index')->with('status','Map Added');
        } else{
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MatchMap  $matchMap
     * @return \Illuminate\Http\Response
     */
    public function show(MatchMap $matchMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MatchMap  $matchMap
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchMap $matchMap)
    {
        return view('admin_area.match_map.edit',compact('matchMap'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MatchMap  $matchMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatchMap $matchMap)
    {
        $data = $request->except('_token');

        $validate = Validator::make($data,[
            'title' => 'required',
            'path' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $matchMap->update($data);
        if($matchMap->save()){
            return redirect()->back()->with('status','Map Update');
        } else{
            return redirect()->back()->with('status','Map not Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MatchMap  $matchMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatchMap $matchMap)
    {
        $matchMap->delete();
        return redirect()->back()->with('status','Map delete');
    }
}
