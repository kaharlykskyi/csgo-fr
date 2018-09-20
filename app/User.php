<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
        'city',
        'sex',
        'role',
        'date_birth',
        'email_token',
        'moderators',
        'twitch_profile',
        'steam_profile',
        'description',
        'faceit_profile',
        'youtube_profile',
        'instagram_profile',
        'twitter_profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
