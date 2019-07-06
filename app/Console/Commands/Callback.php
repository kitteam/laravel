<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Callback extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'callback:tele2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tele2 ATS callback command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(\Tele2 $tele2)
    {
        if ($current = $tele2::getCurrent()) {
            //
        }
    }
}
