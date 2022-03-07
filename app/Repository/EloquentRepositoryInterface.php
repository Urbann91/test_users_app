<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param $id
     * @param array $data
     * @return bool|null
     */
    public function update($id, array $data): ?bool;

    /**
     * @param $ids
     * @return int
     */
    public function delete($ids): int;
}
