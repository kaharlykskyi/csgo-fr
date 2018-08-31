<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'news_categoryes';

    protected $fillable = ['name'];
}
