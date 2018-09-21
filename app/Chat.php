<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'creator',
        'recipient'
    ];

    protected $table = 'chats';

    public function massage(){
        return $this->hasMany('App\ChatMassege')->orderByDesc('created_at');
    }
}
