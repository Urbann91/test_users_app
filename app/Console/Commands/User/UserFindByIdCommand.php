<?php

namespace App\Console\Commands\User;

use App\Repository\UserRepositoryInterface;
use Illuminate\Console\Command;

class UserFindByIdCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:find-by-id {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get single user by id (return json format)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository): void
    {
        /*
            транзакция с блокировкой строки ->lockForUpdate() опущены, но учтены
            DB::transaction(function () use ($ids, $declineReason, $appMaster) {

            });
        */

        $this->printIt(optional($userRepository->find($this->argument('id')))->toJson());
    }

    /**
     * @param string $result
     */
    public function printIt(?string $result)
    {
        $this->info($result);
    }
}
