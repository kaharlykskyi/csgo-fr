<?php

namespace App\Http\Controllers\Admin;

use App\Player;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::paginate(20);
        $countries = DB::table('countrys')->get();
        return view('admin_area.player.index', compact('players','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = DB::table('countrys')->get();
        $teams = Team::all();
        return view('admin_area.player.create', compact('countries','teams'));
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
            'nickname' => 'required|unique:players',
            'age' => 'integer',
            'country' => 'required',
        ]);

        if($data['team_id'] == 0){
            $data['team_id'] = null;
        }

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $data['account_type'] = 'player';

        $player = new Player();
        $player->fill($data);
        if($player->save()){
            if(isset($data['team_id'])){
                DB::table('team_history')->insert([
                    'player_id' => $player->id,
                    'team_id' => $player->team_id,
                    'message' => "player {$player->nickname} added to team",
                    'created_at' => Carbon::now()
                ]);
            }
            return redirect()->route('admin.players.index')->with('status','Player Added');
        } else{
            dump($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $countries = DB::table('countrys')->get();
        $teams = Team::all();
        return view('admin_area.player.edit',compact('countries','player','teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $data = $request->except('_token');

        $validate = Validator::make($data,[
            'nickname' => 'required',
            'age' => 'integer',
            'country' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if($data['team_id'] == 0){
            $data['team_id'] = null;
        }

        if (isset($data['team_id'])){
            $old_team_id = $player->team_id;
        } elseif (isset($player->team_id)) {
            DB::table('team_history')->insert([
                'player_id' => $player->id,
                'team_id' => $player->team_id,
                'message' => "player {$player->nickname} removed from team",
                'created_at' => Carbon::now()
            ]);
        }

        $data['account_type'] = 'player';

        $player->update($data);
        if($player->save()){
            if (isset($data['team_id']) && isset($player->team_id)){
                if($old_team_id != $player->team_id){
                    DB::table('team_history')->insert([
                        ['player_id' => $player->id,
                        'team_id' => $old_team_id,
                        'message' => "player {$player->nickname} removed from team",
                        'created_at' => Carbon::now()],
                        ['player_id' => $player->id,
                            'team_id' => $player->team_id,
                            'message' => "player {$player->nickname} added to team",
                            'created_at' => Carbon::now()]
                    ]);
                } else {
                    DB::table('team_history')->insert([
                        ['player_id' => $player->id,
                            'team_id' => $data['team_id'],
                            'message' => "player {$player->nickname} added to team",
                            'created_at' => Carbon::now()]
                    ]);
                }
            }
            return redirect()->back()->with('status','Player Added');
        } else{
            dump($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return back()->with('status','Player deleted');
    }
}
