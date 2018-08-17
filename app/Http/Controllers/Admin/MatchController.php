<?php

namespace App\Http\Controllers\Admin;

use App\Match;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::paginate(20);
        return view('admin_area.matches.index',compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_area.matches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make(['match_day' => $request->match_day],[
            'match_day' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->getMessageBag()
            ]);

        }

        $match = new Match();
        $match->fill([
            'match_day' => $request->match_day,
            'fin_score' => json_encode($request->scoreArray),
            'stream_link' => json_encode($request->linkArray)
        ]);
        $match->save();

        return $match->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        $countrys = DB::table('countrys')->get();
        return view('admin_area.matches.view_match',compact('match','countrys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        $countries = DB::table('countrys')->get();
        return view('admin_area.matches.edit',compact('match','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {

        if($request->team){
            $match->update([
                'team' => json_encode($request->post())
            ]);

            return $request;
        }

        if($request->map){
            $match->update([
                'map' => json_encode($request->mapArray)
            ]);

            return $request;
        }

        if($request->match_inf){
            $match->update([
                'match_day' => $request->match_day,
                'fin_score' => json_encode($request->scoreArray),
                'stream_link' => json_encode($request->linkArray)
            ]);

            return $request;
        }

        return redirect()->route('admin.matches.update',$match->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        $match->delete();
        return redirect()->route('admin.matches.index');
    }
}
