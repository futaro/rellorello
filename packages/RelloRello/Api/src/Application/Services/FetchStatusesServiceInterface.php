<?php

namespace RelloRello\Api\Application\Services;

use RelloRello\Api\Application\Requests\FetchStatusesRequest;
use RelloRello\Api\Domain\Models\Status;

/**
 * Interface FetchStatusesServiceInterface
 *
 * @package RelloRello\Api\Application\Services
 */
interface FetchStatusesServiceInterface
{
    /**
     * @param FetchStatusesRequest $request
     * @return Status[]
     */
    public function fetch(FetchStatusesRequest $request): array;
}