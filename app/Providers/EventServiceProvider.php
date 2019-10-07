<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
     protected $listen = [
         'App\Events\Auth\UserRegistered' => [
             'App\Listeners\Auth\SendRegisterNotification',
         ],
         'App\Events\Auth\UserConfirmation' => [
             'App\Listeners\Auth\SendConfirmationNotification',
         ],
         // Telephony
         'App\Events\Callback\IncomingCall' => [
             'App\Listeners\Callback\SendIncomingСallNotification',
         ],
     ];

     protected $subscribe = [
         //
     ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
