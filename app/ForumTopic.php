<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    protected $fillable = [
        'title',
        'description',
        'logo',
        'user_id'
    ];
}
