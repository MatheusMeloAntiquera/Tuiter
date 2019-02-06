<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interactions extends Model
{
    protected $fillable = [
        'user_id', 'type', 'tweet_id',
    ];
}
