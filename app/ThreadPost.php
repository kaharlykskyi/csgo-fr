<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadPost extends Model
{
    protected $fillable = [
        'text_post',
        'thread_id',
        'user_id',
        'parent_post',
        'sequence_number'
    ];

    public function children(){
        return $this->hasMany(self::class, 'parent_post');
    }
}
