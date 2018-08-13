<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'short_title',
        'content_news',
        'banner_image',
        'country_id',
        'enabled',
        'user_id',
        'publication_date',
    ];
}
