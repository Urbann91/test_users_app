<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\User\UserCreateCommand::class,
        \App\Console\Commands\User\UserFindByIdCommand::class,
        \App\Console\Commands\User\UserGetAllCommand::class,
        \App\Console\Commands\User\UserSoftDeleteByIdCommand::class,
        \App\Console\Commands\User\UserUpdateCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
