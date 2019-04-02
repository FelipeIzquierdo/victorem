<?php

namespace Victorem\Console;

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
        \Victorem\Console\Commands\Inspire::class,
        \Victorem\Console\Commands\Birthday::class,
        \Victorem\Console\Commands\UpdatePollingStations::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        $schedule->command('command:birthday')
            ->dailyAt('17:00');

        $schedule->command('command:birthday')
            ->dailyAt('09:30');

    }
}
