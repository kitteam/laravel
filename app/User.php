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
        'birthdate',
        'email',
        'phone',
        'passport',
        'address',
        'password',
    ];

    protected $dates = ['birthdate'];

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

    /**
     * Encode the given value as JSON.
     *
     * @param  mixed  $value
     * @return string
     */
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function domain()
    {
        return $this->hasMany('App\UserDomain');
    }

    public function hosting()
    {
        return $this->hasMany('App\UserHosting');
    }
}
