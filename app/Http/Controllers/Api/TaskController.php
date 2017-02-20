<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * TaskController constructor.
     */
    public function __construct()
    {

    }

    public function index()
    {
        /** @var Status[] $statuses */
        $statuses = Status::where('project_id', 1)
                          ->orderBy('order_num')
                          ->get();

        $return_values = [];
        foreach ($statuses as $status) {

            $return_values[] = [
                'status' => $status->subject,
                'tasks' => $status->tasks()
                                  ->orderBy('order_num')
                                  ->get()
            ];
        }

        return $return_values;
    }

    public function create()
    {
        //
    }

    public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'subject' => 'required',
            'created_user_id' => 'required|numeric',
            'assignee_user_id' => 'numeric|nullable',
            'status_id' => 'required'
        );

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return ['status' => false, 'errors' => $validator->messages()
                                                             ->toArray()];

        } else {
            // store
            $task = new Task();
            $task->subject = Input::get('subject');
            $task->description = Input::get('description');
            $task->created_user_id = Input::get('created_user_id');
            $task->assignee_user_id = Input::get('assignee_user_id');
            $task->status_id = Input::get('status_id');

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

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
