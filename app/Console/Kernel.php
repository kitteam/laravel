<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\UserDomains',
        'App\Console\Commands\NsDomains',
        'App\Console\Commands\DetailsDomains',
        'App\Console\Commands\CoverPhotoUpload',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('domains:user')->withoutOverlapping()->hourly();
        $schedule->command('domains:ns')->withoutOverlapping()->hourly();
        $schedule->command('domains:details')->withoutOverlapping()->daily();

        $schedule->command('cover_photo:upload')->withoutOverlapping()->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
