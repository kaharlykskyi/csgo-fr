<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentComment extends Model
{
    protected $fillable = [
        'tournament_id',
        'user_id',
        'comment',
        'parent_comment',
        'like_count'
    ];

    public function children(){
        return $this->hasMany(self::class, 'parent_comment');
    }
}
