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
    /**
     * @param int $id
     * @return Task
     */
    public function findOne(int $id): Task;

    /**
     * @param array $p
     * @return Task[]
     */
    public function find(array $p);

    /**
     * @param int $status_id
     * @return int
     */
    public function getMaxOrderNum(int $status_id): int;

    /**
     * @param Task $task
     * @return Task
     */
    public function save(Task $task): Task;

    /**
     * @param int $id
     */
    public function destroy(int $id);
}