<?php

namespace App\Events\Auth;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\User;

class UserRegistered
{
    use Dispatchable, SerializesModels;

    public $user;

    public $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
}
