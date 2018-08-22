<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'match_day',
        'fin_score',
        'team',
        'map',
        'stream_link',
        'tournament'
    ];
}
