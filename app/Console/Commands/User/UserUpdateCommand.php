<?php

namespace App\Console\Commands\User;

use App\Repository\UserRepositoryInterface;
use Illuminate\Console\Command;

class UserUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update {id} {--name=} {--email=} {--notes=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user (return json format)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository): void
    {
        $this->printIt($userRepository->update($this->argument('id'), array_filter($this->options())));
    }

    /**
     * @param string $result
     */
    public function printIt(?string $result)
    {
        $this->info($result);
    }
}
