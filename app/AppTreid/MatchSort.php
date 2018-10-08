<?php
/**
 * Created by PhpStorm.
 * User: Seliv
 * Date: 04.09.2018
 * Time: 21:37
 */

namespace App\AppTreid;


use App\Match;
use Illuminate\Support\Facades\DB;

trait MatchSort
{
    public $sort_match = null;

    public function selectMatch(){
        $count_latest_match_scoreboard = DB::table('settings')->where('name','=','count_latest_match_scoreboard')->select('value')->first();
        $count_live_match_scoreboard = DB::table('settings')->where('name','=','count_live_match_scoreboard')->select('value')->first();
        $count_upcoming_match_scoreboard = DB::table('settings')->where('name','=','count_upcoming_match_scoreboard')->select('value')->first();

        $latest_match = Match::whereRaw("TIMESTAMPDIFF(MINUTE, match_day, CURRENT_TIMESTAMP) > 120")->limit((int)$count_latest_match_scoreboard->value)->get();
        $live_match = Match::whereRaw("(TIMESTAMPDIFF(MINUTE, match_day, CURRENT_TIMESTAMP) < 120) AND (TIMESTAMPDIFF(MINUTE, CURRENT_TIMESTAMP, match_day) < 60)")->limit((int)$count_live_match_scoreboard->value)->get();
        $upcoming_matches = Match::whereRaw("TIMESTAMPDIFF(MINUTE, CURRENT_TIMESTAMP, match_day) > 60")->limit((int)$count_upcoming_match_scoreboard->value)->get();

        $this->setArray($upcoming_matches,'upcoming_matches');
        $this->setArray($live_match,'live_match');
        $this->setArray($latest_match,'latest_match');

        return $this->sort_match;
    }

    public function setArray($array, $type){
        foreach ($array as $match){
            $this->sort_match[] = (object)[
                'match_data' => $match,
                'type' => $type
            ];
        }
    }
}