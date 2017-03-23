<?php

namespace RelloRello\Api\Domain\Repositories;

use RelloRello\Api\Domain\Models\Status;

/**
 * Interface StatusRepository
 *
 * @package RelloRello\Api\Domain\Repositories
 */
interface StatusRepository
{
    /**
     * @param int $id
     * @return Status
     */
    public function findOne(int $id): Status;

    /**
     * @param array $p
     * @return Status[]
     */
    public function find(array $p);

    /**
     * @param array $p
     * @return mixed
     */
    public function findAsArray(array $p);

    /**
     * @param $project_id
     * @return int
     */
    public function getMaxOrderNum(int $project_id): int;

    /**
     * @param Status $status
     * @return Status
     */
    public function save(Status $status): Status;

    /**
     * @param int $id
     */
    public function destroy(int $id);

    /**
     * @param array $sort_statuses
     * @return bool
     */
    public function updateOrderNum(array $sort_statuses): bool;
}