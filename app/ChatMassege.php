<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMassege extends Model
{
    protected $fillable = [
        'user',
        'user2',
        'seen',
        'seen2',
        'massage'
    ];

    protected $table = 'chat_masseges';
}
