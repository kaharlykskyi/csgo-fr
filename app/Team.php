<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'logo',
        'name',
        'game',
        'country'
    ];
}
