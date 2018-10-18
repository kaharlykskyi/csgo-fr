<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchMap extends Model
{
    protected $table = 'match_maps';

    protected $fillable = ['title','path'];
}
