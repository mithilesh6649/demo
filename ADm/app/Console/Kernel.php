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
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:retry all')->everyTwoMinutes();
        $schedule->command('change:cron_time')->twiceDaily(11, 12);
        $schedule->command('remind:weight')->dailyAt('11:30');
        $schedule->command('remind:water')->everyMinute();
        $schedule->command('remind:medicine')->everyMinute();
        $schedule->command('change_medicine_reminder:status')->daily();
        $schedule->command('remind:step')->everyMinute();
        $schedule->command('deactive:plan')->daily();
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
