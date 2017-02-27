<?php

namespace RelloRello\Api\Application\Services;

use RelloRello\Api\Application\Requests\StoreTaskRequest;
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

//    public function update(UpdateTaskRequest $request);
}