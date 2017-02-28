<?php

namespace RelloRello\Api\Application\Controllers;

use Illuminate\Http\JsonResponse;
use RelloRello\Api\Application\Requests;
use RelloRello\Api\Application\Services\FetchTasksServiceInterface;
use App\Http\Controllers\Controller;
use RelloRello\Api\Application\Services\ManipulateTaskServiceInterface;
use RelloRello\Api\Domain\Models\Task;

/**
 * Class TaskController
 *
 * @package RelloRello\Api\Application\Controllers
 */
class TaskController extends Controller
{
    /**
     * @param Requests\FetchTasksRequest $request
     * @param JsonResponse $response
     * @param FetchTasksServiceInterface $service
     * @return JsonResponse
     */
    public function index(Requests\FetchTasksRequest $request, JsonResponse $response, FetchTasksServiceInterface $service)
    {
        $tasks = $service->fetch($request);

        $tasks = array_map(function(Task $task){
            return $task->toArray();
        }, $tasks);

        return $response->setData($tasks);
    }

    /**
     * @todo いるかな
     * @param int $id
     * @param JsonResponse $response
     */
    public function show(int $id, JsonResponse $response)
    {
        //
    }

    /**
     * @param Requests\StoreTaskRequest $request
     * @param JsonResponse $response
     * @param ManipulateTaskServiceInterface $service
     * @return JsonResponse
     */
    public function store(Requests\StoreTaskRequest $request, JsonResponse $response, ManipulateTaskServiceInterface $service)
    {
        return $response->setData([
            'status' => true,
            'task' => $service->store($request)
                              ->toArray()
        ]);
    }

    /**
     * @param int $id
     * @param Requests\UpdateTaskRequest $request
     * @param JsonResponse $response
     * @param ManipulateTaskServiceInterface $service
     * @return JsonResponse
     */
    public function update(int $id, Requests\UpdateTaskRequest $request, JsonResponse $response, ManipulateTaskServiceInterface $service)
    {
        return $response->setData([
            'status' => true,
            'task' => $service->update($id, $request)
                              ->toArray()
        ]);
    }

    /**
     * @param int $id
     * @param JsonResponse $response
     * @param ManipulateTaskServiceInterface $service
     * @return JsonResponse
     */
    public function destroy(int $id, JsonResponse $response, ManipulateTaskServiceInterface $service)
    {
        $service->destroy($id);

        return $response->setData(['status' => true, 'id' => $id]);
    }
}
