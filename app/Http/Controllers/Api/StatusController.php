<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
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
        $statuses = Status::with('tasks')->where('project_id', 1)->orderBy('order_num')->get();

        return $statuses;
    }

    public function create()
    {
        //
    }

    public function store()
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
            $status = new Status();
            $this->setRequestParams($status);

            $status_orders = Status::where('project_id', $status->project_id)
                ->orderBy('order_num', 'DESC')
                ->pluck('order_num')
                ->toArray();

            if (!is_array($status_orders) || count($status_orders) <= 0) {
                $status->order_num = 1;
            } else {
                $status->order_num = $status_orders[0] + 1;
            }

            $status->save();

            return ['status' => true, 'model' => $status];
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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = $this->getRules();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return ['status' => false, 'errors' => $validator->messages()->toArray()];
        } else {

            $status = Status::find($id);

            if (!$status) {
                return ['status' => false, 'errors' => 'Invalid id'];
            }

            $this->setRequestParams($status);
            $status->save();

            return ['status' => true, 'model' => $status];
        }
    }

    public function destroy($id)
    {
        Status::destroy($id);
        return ['status' => true, 'id' => $id];
    }

    /**
     * @return array
     */
    private function getRules()
    {
        return [
            'subject' => 'required',
            'project_id' => 'required'
        ];
    }

    /**
     * @param Status $status
     */
    private function setRequestParams(Status $status)
    {
        $status->subject = Input::get('subject');
        $status->project_id = Input::get('project_id');
    }

}
