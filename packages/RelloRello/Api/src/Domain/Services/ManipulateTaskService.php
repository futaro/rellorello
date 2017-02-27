<?php

namespace RelloRello\Api\Domain\Services;

use Carbon\Carbon;
use RelloRello\Api\Application\Requests\StoreTaskRequest;
use RelloRello\Api\Application\Services\ManipulateTaskServiceInterface;
use RelloRello\Api\Domain\Models\Task;
use RelloRello\Api\Domain\Repositories\TaskRepository;

/**
 * Class ManipulateTaskService
 *
 * @package RelloRello\Api\Domain\Services
 */
class ManipulateTaskService implements ManipulateTaskServiceInterface
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param StoreTaskRequest $request
     * @return Task
     */
    public function store(StoreTaskRequest $request): Task
    {
        $max_order_num = $this->taskRepository->getMaxOrderNum($request->getStatusId());

        $task = new Task(
            null,
            $request->getSubject(),
            $request->getDescription(),
            $request->getCreatedUserId(),
            $request->getAssigneeUserId(),
            $request->getStatusId(),
            $max_order_num + 1,
            new Carbon()
        );

        return $this->taskRepository->save($task);
    }
}