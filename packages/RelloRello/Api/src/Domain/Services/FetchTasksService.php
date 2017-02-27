<?php

namespace RelloRello\Api\Domain\Services;

use RelloRello\Api\Application\Requests\FetchTasksRequest;
use RelloRello\Api\Application\Services\FetchTasksServiceInterface;
use RelloRello\Api\Domain\Models\Task;
use RelloRello\Api\Domain\Repositories\TaskRepository;

/**
 * Class FetchTasksService
 *
 * @package RelloRello\Api\Domain\Services
 */
class FetchTasksService implements FetchTasksServiceInterface
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
     * @param FetchTasksRequest $request
     * @return Task[]|array
     * @throws \Exception
     */
    public function fetch(FetchTasksRequest $request): array
    {
        $params = ['where' => null];

        if ($project_id = $request->getProjectId()) {
            $params['where']['statuses.project_id'] = $project_id;
        }

        if ($status_id = $request->getStatusId()) {
            $params['where']['status_id'] = $status_id;
        }

        if ($limit = $request->getLimit()) {
            $params['limit'] = $limit;
        }

        return $this->taskRepository->findAsArray($params);
    }
}