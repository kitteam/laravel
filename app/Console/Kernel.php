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
        'App\Console\Commands\UpdateCost',
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
        $schedule->command('updates:cost')->withoutOverlapping()->twiceDaily(2,10,18);
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
