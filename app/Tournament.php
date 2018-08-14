<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'title',
        'short_title',
        'content_tournament',
        'banner_image',
        'country_id',
        'user_id',
        'publication_date',
        'tournament_metadata',
        'author',
    ];
}
