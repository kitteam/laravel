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
        'middlename',
        'surname',
        'email',
        'phone',
        'passport',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'passport' => 'array',
        'address' => 'array'
    ];

    public function domain()
    {
        return $this->hasMany('App\UserDomain');
    }

    public function hosting()
    {
        return $this->hasMany('App\UserHosting');
    }
}
