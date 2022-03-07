<?php

namespace App\Providers;

use App\Validator\BaseDataValidator;
use App\Validator\DataValidatorInterface;
use App\Validator\UserDataValidator;
use App\Validator\UserDataValidatorInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class ValidatorDataServiceProvider
 */
class ValidatorDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DataValidatorInterface::class, BaseDataValidator::class);
        $this->app->bind(UserDataValidatorInterface::class, UserDataValidator::class);
    }
}
