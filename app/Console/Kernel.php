<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Commands\ModuleCommand::class,
        \App\Console\Commands\FreezeSharesCommand::class,
        \App\Console\Commands\MemberGroupCommand::class,
        \App\Console\Commands\BonusPairingCommand::class,
        \App\Console\Commands\BonusGroupCommand::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            \Artisan::call('down');
        })->dailyAt('23:45');

        $schedule->call(function () {
            \Artisan::call('shares:freeze');
        })->dailyAt('00:00')->evenInMaintenanceMode();

        $schedule->call(function () {
            \Artisan::call('member:group');
        })->dailyAt('00:30')->evenInMaintenanceMode();

        $schedule->call(function () {
            \Artisan::call('bonus:pairing');
        })->dailyAt('01:00')->evenInMaintenanceMode();

        $schedule->call(function () {
            \Artisan::call('bonus:group');
        })->dailyAt('01:30')->evenInMaintenanceMode();
        
        $schedule->call(function(){
            \Artisan::call('up');
        })->dailyAt('02:00')->evenInMaintenanceMode();
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
