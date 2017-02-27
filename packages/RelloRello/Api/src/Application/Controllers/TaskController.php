<?php

namespace RelloRello\Api\Application\Controllers;

use RelloRello\Api\Application\Requests\FetchTasksRequest;
use RelloRello\Api\Application\Requests\StoreTaskRequest;
use RelloRello\Api\Application\Services\FetchTasksServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @param StoreTaskRequest $request
     *
     * @return array
     */
    public function store(StoreTaskRequest $request)
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
            // store
            $task = new Task();
            $this->setRequestParams($task);

            $task_orders = Task::where('status_id', $task->status_id)
                               ->orderBy('order_num', 'DESC')
                               ->pluck('order_num')
                               ->toArray();

            if (!is_array($task_orders) || count($task_orders) <= 0) {
                $task->order_num = 1;
            } else {
                $task->order_num = $task_orders[0] + 1;
            }

            $task->save();

            return ['status' => true, 'task' => $task];
        }
    }

    public function show($id)
    {
        //
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

    /**
     * @return array
     */
    private function getRules()
    {
        return [
            'subject' => 'required',
            'created_user_id' => 'required|numeric',
            'assignee_user_id' => 'numeric|nullable',
            'status_id' => 'required'
        ];
    }

    /**
     * @param Task $task
     */
    private function setRequestParams(Task $task)
    {
        $task->subject = Input::get('subject');
        $task->description = Input::get('description');
        $task->created_user_id = Input::get('created_user_id');
        $task->assignee_user_id = Input::get('assignee_user_id');
        $task->status_id = Input::get('status_id');
    }

}
