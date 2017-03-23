<?php

use RelloRello\Api\Application\Controllers;

/** @var \Illuminate\Routing\Router $router */
$router = app('router');

$router->group(['as' => 'api::', 'prefix' => 'api', 'middleware' => 'web'], function () use ($router) {

    $router->resource('statuses', Controllers\StatusController::class, ['except' => ['create', 'edit']]);
    $router->post('statuses/sort', 'RelloRello\Api\Application\Controllers\StatusController@sort');
    $router->resource('tasks', Controllers\TaskController::class, ['except' => ['create', 'edit']]);
});

