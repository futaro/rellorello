<?php

namespace RelloRello\Api\Application\Controllers;

use RelloRello\Api\Application\Requests\FetchTasksRequest;
use RelloRello\Api\Application\Requests\StoreTaskRequest;
use RelloRello\Api\Application\Services\FetchTasksServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
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
     * @param FetchTasksRequest $request
     * @param FetchTasksServiceInterface $service
     * @return mixed
     */
    public function index(FetchTasksRequest $request, FetchTasksServiceInterface $service)
    {
        return Response::json($service->fetch($request));
    }

    public function show()
    {
        //
    }

    /**
     * @param StoreTaskRequest $request
     *
     * @param ManipulateTaskServiceInterface $service
     * @return array
     */
    public function store(StoreTaskRequest $request, ManipulateTaskServiceInterface $service)
    {
        $task = $service->store($request);

        return Response::json(['status' => true, 'task' => $task->toArray()]);
    }


    public function update($id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = $this->getRules();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return ['status' => false, 'errors' => $validator->messages()
                                                             ->toArray()];
        } else {

            $task = Task::find($id);

            if (!$task) {
                return ['status' => false, 'errors' => 'Invalid id'];
            }

            $this->setRequestParams($task);
            $task->save();

            return ['status' => true, 'task' => $task];
        }
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return ['status' => true, 'id' => $id];
    }


}
