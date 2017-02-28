<?php

namespace RelloRello\Api\Application\Services;

use RelloRello\Api\Application\Requests\StoreTaskRequest;
use RelloRello\Api\Application\Requests\UpdateTaskRequest;
use RelloRello\Api\Domain\Models\Task;

/**
 * Interface ManipulateStatusesServiceInterface
 *
 * @package RelloRello\Api\Application\Services
 */
interface ManipulateTaskServiceInterface
{
    /**
     * @param StoreTaskRequest $request
     * @return Task
     */
    public function store(StoreTaskRequest $request): Task;

    /**
     * @param int $id
     * @param UpdateTaskRequest $request
     * @return Task
     */
    public function update(int $id, UpdateTaskRequest $request): Task;

    /**
     * @param int $id
     */
    public function destroy(int $id);
}