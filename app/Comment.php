<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments_match';

    protected $fillable = [
        'match_id',
        'user_id',
        'comment'
    ];
}