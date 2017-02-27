<?php

namespace RelloRello\Api\Application\Services;

use RelloRello\Api\Application\Requests\FetchTasksRequest;
use RelloRello\Api\Domain\Models\Task;

/**
 * Interface fetchTasksServiceInterface
 *
 * @package RelloRello\Api\Application\Services
 */
interface FetchTasksServiceInterface
{
    /**
     * @param FetchTasksRequest $request
     * @return Task[]
     */
    public function fetch(FetchTasksRequest $request): array;
}