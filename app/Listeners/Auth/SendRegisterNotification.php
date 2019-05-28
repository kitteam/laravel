<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserRegistered;
use App\Mail\Auth\RegistrationEmail;
use Mail;

class SendRegisterNotification
{
    public function handle(UserRegistered $event)
    {
        Mail::to($event->user->email)->send(new RegistrationEmail($event->user, $event->password));
    }
}
