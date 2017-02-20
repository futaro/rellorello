<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;

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
        //
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
