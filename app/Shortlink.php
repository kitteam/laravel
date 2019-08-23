<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shortlink extends Model
{
    protected $fillable = [
        'shortlink',
        'url'
    ];
}
