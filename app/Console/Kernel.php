<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('system-updates:accounts')->fridays()->at('16:00');
        $schedule->command('system-updates:enumerators')->fridays()->at('16:15');
        $schedule->command('system-updates:farmers')->fridays()->at('16:30');
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

//     protected $middleware = [
//         //...
//         \Illuminate\Session\Middleware\StartSession::class,
//         \Illuminate\View\Middleware\ShareErrorsFromSession::class,
// ];
}
