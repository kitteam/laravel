<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHosting extends Model
{
    protected $fillable = [
        'hosting_id', 'expiration_at'
    ];

    protected $dates = ['expiration_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function hosting()
    {
        return $this->belongsTo('App\Hosting');
    }
}
