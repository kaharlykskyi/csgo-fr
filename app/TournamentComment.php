<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentComment extends Model
{
    protected $fillable = [
        'tournament_id',
        'user_id',
        'comment'
    ];
}
