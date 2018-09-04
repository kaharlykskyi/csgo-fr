<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    protected $table = 'news_comments';

    protected $fillable = [
        'news_id',
        'user_id',
        'comment',
        'parent_comment',
        'like_count'
    ];

    public function children(){
        return $this->hasMany(self::class, 'parent_comment');
    }
}
