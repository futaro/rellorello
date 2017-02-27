<?php

namespace RelloRello\Api\Domain\Services;

use RelloRello\Api\Application\Requests\FetchStatusesRequest;
use RelloRello\Api\Application\Services\FetchStatusesServiceInterface;
use RelloRello\Api\Domain\Models\Status;
use RelloRello\Api\Domain\Repositories\StatusRepository;

/**
 * Class FetchStatusesService
 *
 * @package RelloRello\Api\Domain\Services
 */
class FetchStatusesService implements FetchStatusesServiceInterface
{
    /**
     * @var StatusRepository
     */
    private $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * @param FetchStatusesRequest $request
     * @return Status[]|array
     * @throws \Exception
     */
    public function fetch(FetchStatusesRequest $request): array
    {
        $params = ['where' => null];

        if ($project_id = $request->getProjectId()) {
            $params['where']['project_id'] = $project_id;
        }

        return $this->statusRepository->findAsArray($params);
    }
}