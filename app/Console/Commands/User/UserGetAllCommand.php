<?php

namespace App\Console\Commands\User;

use App\Repository\UserRepositoryInterface;
use Illuminate\Console\Command;

class UserGetAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:get-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all users from table (return json format)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository): void
    {
        dd($userRepository->all()->toJson());
    }
}
