<?php

namespace RelloRello\Api\Domain\Repositories;

use RelloRello\Api\Domain\Models\Task;

/**
 * Interface TaskRepository
 *
 * @package RelloRello\Api\Domain\Repositories
 */
interface TaskRepository
{
    public function find(array $p);

    public function findAsArray(array $p);

    public function getMaxOrderNum(int $status_id): int;

    public function save(Task $task);
}