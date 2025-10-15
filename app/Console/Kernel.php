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
        Commands\CombinedpdfCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('Combinedpdf:cron')->everyMinute();
        $schedule->command('Docnotuploaded:cron')
        ->dailyAt('16:30');
        $schedule->command('ClientNotLoggedIn:cron')
        ->dailyAt('16:00');
        $schedule->command('AutomatedNotificationTemplateCron:cron')
        ->dailyAt('20:00');
        $schedule->command('DeleteMarkedUsers:cron')
        ->dailyAt('20:30');
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
