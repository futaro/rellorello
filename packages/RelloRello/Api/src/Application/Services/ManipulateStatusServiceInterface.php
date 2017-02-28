<?php

namespace RelloRello\Api\Application\Services;

use RelloRello\Api\Application\Requests\StoreStatusRequest;
use RelloRello\Api\Application\Requests\UpdateStatusRequest;
use RelloRello\Api\Domain\Models\Status;

/**
 * Interface ManipulateStatusServiceInterface
 *
 * @package RelloRello\Api\Application\Services
 */
interface ManipulateStatusServiceInterface
{
    /**
     * @param StoreStatusRequest $request
     * @return Status
     */
    public function store(StoreStatusRequest $request): Status;

    /**
     * @param int $id
     * @param UpdateStatusRequest $request
     * @return Status
     */
    public function update(int $id, UpdateStatusRequest $request): Status;

    /**
     * @param int $id
     */
    public function destroy(int $id);
}