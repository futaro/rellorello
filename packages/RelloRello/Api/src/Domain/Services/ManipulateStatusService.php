<?php

namespace RelloRello\Api\Domain\Services;

use RelloRello\Api\Application\Requests\StoreStatusRequest;
use RelloRello\Api\Application\Requests\UpdateStatusRequest;
use RelloRello\Api\Application\Services\ManipulateStatusServiceInterface;
use RelloRello\Api\Domain\Models\Status;
use RelloRello\Api\Domain\Repositories\StatusRepository;

/**
 * Class ManipulateStatusService
 *
 * @package RelloRello\Api\Domain\Services
 */
class ManipulateStatusService implements ManipulateStatusServiceInterface
{
    /**
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     * ManipulateStatusService constructor.
     *
     * @param StatusRepository $statusRepository
     */
    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * @param StoreStatusRequest $request
     * @return Status
     */
    public function store(StoreStatusRequest $request): Status
    {
        $max_order_num = $this->statusRepository->getMaxOrderNum($request->getProjectId());

        $status = new Status(
            null,
            $request->getProjectId(),
            $request->getSubject(),
            $max_order_num + 1
        );

        return $this->statusRepository->save($status);
    }

    /**
     * @param int $id
     * @param UpdateStatusRequest $request
     * @return Status
     */
    public function update(int $id, UpdateStatusRequest $request): Status
    {
        $org_status_arr = $this->statusRepository->findOne($id)
                                                 ->toArray();

        $org_status_arr['project_id'] = $request->getProjectId();
        $org_status_arr['subject'] = $request->getSubject();

        $status = new Status(
            $id,
            $org_status_arr['project_id'],
            $org_status_arr['subject'],
            $org_status_arr['order_num']
        );

        return $this->statusRepository->save($status);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->statusRepository->destroy($id);
    }
}