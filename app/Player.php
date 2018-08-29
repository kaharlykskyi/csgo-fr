<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'logo',
        'nickname',
        'full_name',
        'country',
        'age',
        'team_id',
        'account_type'
    ];
}
