<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDomain extends Model
{
    protected $dates = ['expiration_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
