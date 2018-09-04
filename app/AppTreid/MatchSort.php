<?php
/**
 * Created by PhpStorm.
 * User: Seliv
 * Date: 04.09.2018
 * Time: 21:37
 */

namespace App\AppTreid;


use App\Match;

trait MatchSort
{
    public $sort_match = null;

    public function selectMatch(){
        $latest_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, match_day, NOW()) > 2")->limit(20)->get();
        $live_match = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) IN (0,1,2)")->limit(10)->get();
        $upcoming_matches = Match::whereRaw("TIMESTAMPDIFF(HOUR, NOW(), match_day) > 2")->limit(10)->get();

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