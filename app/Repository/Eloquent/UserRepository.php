<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use App\Validator\UserDataValidatorInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var UserDataValidatorInterface
     */
    protected $userDataValidator;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model, UserDataValidatorInterface $userDataValidator)
    {
        parent::__construct($model);
        $this->userDataValidator = $userDataValidator;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $this->userDataValidator->isPassed($attributes);

        return parent::create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return bool
     */
    public function update($id, array $attributes): ?bool
    {
        $this->userDataValidator->isPassed($attributes);

        return parent::update($id, $attributes);
    }
}
