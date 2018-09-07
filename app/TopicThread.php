<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicThread extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'topic_id',
        'state'
    ];
}
