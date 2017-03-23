<?php

namespace RelloRello\Api\Application\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use RelloRello\Api\Application\Requests;
use RelloRello\Api\Application\Services;

/**
 * Class StatusController
 * @package RelloRello\Api\Application\Controllers
 */
class StatusController extends Controller
{
    /**
     * @param Requests\FetchStatusesRequest $request
     * @param JsonResponse $response
     * @param Services\FetchStatusesServiceInterface $service
     * @return JsonResponse
     */
    public function index(Requests\FetchStatusesRequest $request, JsonResponse $response, Services\FetchStatusesServiceInterface $service)
    {
        return $response->setData($service->fetch($request));
    }

    public function show($id)
    {
        //
    }

    /**
     * @param Requests\StoreStatusRequest $request
     * @param JsonResponse $response
     * @param Services\ManipulateStatusServiceInterface $service
     * @return JsonResponse
     */
    public function store(Requests\StoreStatusRequest $request, JsonResponse $response, Services\ManipulateStatusServiceInterface $service)
    {
        return $response->setData([
            'status' => true,
            'model' => $service->store($request)
                               ->toArray()
        ]);
    }

    /**
     * @param int $id
     * @param Requests\UpdateStatusRequest $request
     * @param JsonResponse $response
     * @param Services\ManipulateStatusServiceInterface $service
     * @return JsonResponse
     */
    public function update(int $id, Requests\UpdateStatusRequest $request, JsonResponse $response, Services\ManipulateStatusServiceInterface $service)
    {
        return $response->setData([
            'status' => true,
            'model' => $service->update($id, $request)
                               ->toArray()
        ]);
    }

    /**
     * @param int $id
     * @param JsonResponse $response
     * @param Services\ManipulateStatusServiceInterface $service
     * @return JsonResponse
     */
    public function destroy(int $id, JsonResponse $response, Services\ManipulateStatusServiceInterface $service)
    {
        $service->destroy($id);

        return $response->setData(['status' => true, 'id' => $id]);
    }

    /**
     * @param Requests\SortStatusesRequest $request
     * @param JsonResponse $response
     * @param Services\ManipulateStatusServiceInterface $service
     * @return $this
     */
    public function sort(Requests\SortStatusesRequest $request, JsonResponse $response, Services\ManipulateStatusServiceInterface $service)
    {
        return $response->setData([
                'status' => $service->sort($request)
            ]
        );
    }
}
