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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('add:move_users_to_insider_users')->hourly();
        // $schedule->command('capital:update:check_insider_user')->hourly();
        // $schedule->command('capital:update:equiti_account_number')->hourly();
        // $schedule->command('capital:update:equiti_invested_amount')->hourly();
        // $schedule->command('capital:update:equiti_monthly_balance_performance_percent_1')->monthlyOn(1, '10:00'); // performance fee include
        // $schedule->command('capital:update:equiti_monthly_balance_performance_percent_2')->monthlyOn(1, '11:00');
        // $schedule->command('capital:update:equiti_monthly_balance_performance_percent_daily')->dailyAt('12:00');
        // $schedule->command('capital:update:equiti_weekly_balance_performance_percent')->weeklyOn(6, '13:00');
        // $schedule->command('capital:update:equiti_performance_fee')->monthlyOn(1, '15:00');

        // $schedule->command('capital:update:multibank_invested_amount')->hourly();
        // $schedule->command('capital:update:multibank_monthly_balance_performance_percent1')->monthly(); // performance fee include
        // $schedule->command('capital:update:multibank_monthly_balance_performance_percent2')->monthlyOn(1, '01:00');
        // $schedule->command('capital:update:multibank_performance_fee')->monthlyOn(1, '08:00');
        // $schedule->command('capital:update:multibank_monthly_balance_performance_percent_daily')->dailyAt('09:00');
        // $schedule->command('capital:update:multibank_weekly_balance_performance_percent')->weeklyOn(6, '14:00');
        // $schedule->command('capital:update:multibank_monthly_deposit')->dailyAt('22:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
