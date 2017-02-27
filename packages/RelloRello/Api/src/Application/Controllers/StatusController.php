<?php

namespace RelloRello\Api\Application\Controllers;

use Illuminate\Support\Facades\Response;
use RelloRello\Api\Application\Requests\FetchStatusesRequest;
use RelloRello\Api\Application\Services\FetchStatusesServiceInterface;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function index(FetchStatusesRequest $request, FetchStatusesServiceInterface $service)
    {
        return Response::json($service->fetch($request));
    }

    public function store()
    {
        //
    }

    public function show($id)
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
