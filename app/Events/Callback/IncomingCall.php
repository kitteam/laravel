<?php

namespace App\Events\Callback;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IncomingCall
{
    use Dispatchable, SerializesModels;

    public $calls;

    public function __construct($calls)
    {
        $this->calls = $calls;
    }
}
