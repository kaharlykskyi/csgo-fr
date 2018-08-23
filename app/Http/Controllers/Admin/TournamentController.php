<?php

namespace App\Http\Controllers\Admin;

use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function PHPSTORM_META\type;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournament::paginate(20);
        return view('admin_area.tournaments.index',compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = DB::table('countrys')->get();
        return view('admin_area.tournaments.create',compact('countries'));
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
            'short_title' => 'required|max:45',
            'content_tournament' => 'required',
            'banner_image' => 'required|file',
            'publication_date' => 'date_format:Y-m-d',
            'author' => 'string|nullable',
            'country_id' => 'required',
        ]);

        if((integer)$data['country_id'] == 0){
            $data['country_id'] = null;
        }

        if ($validate->fails()) {
            return redirect()->route('admin.tournaments.create')
                ->withErrors($validate)
                ->withInput();
        }

        if($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $data['banner_image'] = $file->getClientOriginalName();
            $file->move(public_path() . '/assets/images/tournament_img/',$data['banner_image']);
        }

        $data['user_id'] = Auth::user()->id;

        if(!isset($data['publication_date'])){
            $data['publication_date'] = date('Y-m-d');
        }



        $tournament = new Tournament();
        $tournament->fill($data);
        if($tournament->save()){
            return redirect()->route('admin.tournaments.edit',$tournament->id)->with('status','Tournament Added');
        } else{
            dump($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        return view('admin_area.tournaments.view_tournament',compact('tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        $countries = DB::table('countrys')->get();
        return view('admin_area.tournaments.edit',compact('countries','tournament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {
        if($request->ajax()){
            $tournament->update(['tournament_metadata' => json_encode($request->post())]);
            return "UPDATE Tournament Brackets";
        }

        $data = $request->post();

        $validate = Validator::make($data,[
            'title' => 'required',
            'short_title' => 'required|max:45',
            'content_tournament' => 'required',
            'banner_image' => 'file',
            'publication_date' => 'date_format:Y-m-d',
            'author' => 'string|nullable'
        ]);

        if ($validate->fails()) {
            return redirect()->route('admin.tournaments.edit',$tournament->id)
                ->withErrors($validate)
                ->withInput();
        }

        if((integer)$data['country_id'] == 0){
            $data['country_id'] = null;
        }

        if($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $data['banner_image'] = $file->getClientOriginalName();
            $file->move(public_path() . '/assets/images/tournament_img/',$data['banner_image']);
        }

        if(!isset($data['user_id'])){
            $data['user_id'] = Auth::user()->id;
        }

        if(!isset($data['publication_date'])){
            $data['publication_date'] = date('Y-m-d');
        }

        $tournament->update($data);

        if($tournament->save()){
            return redirect()->route('admin.tournaments.edit',$tournament->id)->with('status','Tournament Updated');
        } else{
            dump($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        $tournament->delete();
        return redirect()->route('admin.tournaments.index');
    }
}
