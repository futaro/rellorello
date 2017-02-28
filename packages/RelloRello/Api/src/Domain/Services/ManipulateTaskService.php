<?php

namespace RelloRello\Api\Domain\Services;

use Carbon\Carbon;
use RelloRello\Api\Application\Requests\StoreTaskRequest;
use RelloRello\Api\Application\Requests\UpdateTaskRequest;
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

    /**
     * ManipulateTaskService constructor.
     *
     * @param TaskRepository $taskRepository
     */
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

    /**
     * @param int $id
     * @param UpdateTaskRequest $request
     * @return Task
     */
    public function update(int $id, UpdateTaskRequest $request): Task
    {
        $org_task_arr = $this->taskRepository->findOne($id)
                                             ->toArray();


        $org_task_arr['subject'] = $request->getSubject();
        $org_task_arr['description'] = $request->getDescription();
        $org_task_arr['created_user_id'] = $request->getCreatedUserId();
        $org_task_arr['assignee_user_id'] = $request->getAssigneeUserId();
        $org_task_arr['status_id'] = $request->getStatusId();

        $task = new Task(
            $id,
            $org_task_arr['subject'],
            $org_task_arr['description'],
            $org_task_arr['created_user_id'],
            $org_task_arr['assignee_user_id'],
            $org_task_arr['status_id'],
            $org_task_arr['order_num'],
            new Carbon($org_task_arr['created'])
        );

        return $this->taskRepository->save($task);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->taskRepository->destroy($id);
    }
}