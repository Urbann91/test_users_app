<?php

namespace App\Console\Commands\User;

use App\Repository\UserRepositoryInterface;
use Illuminate\Console\Command;

class UserSoftDeleteByIdCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:soft-delete-by-id {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Soft delete user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository): void
    {
        $this->printIt($userRepository->delete($this->argument('id')));
    }

    /**
     * @param string $result
     */
    public function printIt(?string $result)
    {
        $this->info($result);
    }
}
