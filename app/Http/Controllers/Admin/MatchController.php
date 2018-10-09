<?php

namespace App\Http\Controllers\Admin;

use App\Match;
use App\Team;
use App\Tournament;
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
        $matches = Match::orderByDesc('created_at')->paginate(20);
        $use_teams = [];
        foreach ($matches as $match){
            $team_data = json_decode($match->team);
            if (isset($team_data)){
                $use_teams[] = (object)[
                    'team1' => Team::where('id',$team_data->team_names1)->first(),
                    'team2' => Team::where('id',$team_data->team_names2)->first()
                ] ;
            }
        }
        return view('admin_area.matches.index',compact('matches','use_teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $turnaments = Tournament::all();
        return view('admin_area.matches.create',compact('turnaments'));
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
            'stream_link' => json_encode($request->linkArray),
            'tournament' => (integer)$request->tournaments
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
        $tournament = Tournament::where('id',$match->tournament)->first();
        $countrys = DB::table('countrys')->get();
        return view('admin_area.matches.view_match',compact('match','countrys','tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        $turnaments = Tournament::all();
        $countries = DB::table('countrys')->get();
        $teams = Team::all();
        return view('admin_area.matches.edit',compact('match','countries','turnaments','teams'));
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

            return $request->post();
        }

        if($request->map){
            $match->update([
                'map' => json_encode($request->mapArray)
            ]);

            return $request->post();
        }

        if($request->match_inf){
            $match->update([
                'match_day' => $request->match_day,
                'fin_score' => json_encode($request->scoreArray),
                'stream_link' => json_encode($request->linkArray),
                'tournament' => (integer)$request->tournaments
            ]);

            return $request->post();
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
