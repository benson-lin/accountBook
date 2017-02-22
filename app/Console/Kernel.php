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
        \App\Console\Commands\Inspire::class,
    	\App\Console\Commands\CleanUnverifyUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    	$suffix = date('Y-m-d');
       	$schedule->command('acountbook:cleanunverifyuser')->cron('*/5 * * * * *')->appendOutputTo("logs/cleanunverifyuser-{$suffix}.log");
    }
}
