<?php

namespace App\Console\Commands\User;

use App\Repository\UserRepositoryInterface;
use Illuminate\Console\Command;

class UserCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--name=} {--email=} {--notes=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user by params (return json format)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository): void
    {
        $this->printIt($userRepository->create($this->options())->toJson());
    }

    /**
     * @param string $result
     */
    public function printIt(?string $result)
    {
        $this->info($result);
    }
}
