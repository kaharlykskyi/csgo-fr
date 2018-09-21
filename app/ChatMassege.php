<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMassege extends Model
{
    protected $fillable = [
        'sender',
        'addressee',
        'seen',
        'chat_id',
        'massage'
    ];

    protected $table = 'chat_masseges';

    public function chat(){
        return $this->belongsTo('App\Chat','chat_id','id');
    }
}
