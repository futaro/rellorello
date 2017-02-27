<?php

namespace RelloRello\Api\Providers;

use RelloRello\Api\Application\Services as ServiceInterface;
use RelloRello\Api\Domain\Services;
use RelloRello\Api\Domain\Repositories;
use RelloRello\Api\Infrastructure\Repositories\Domain\Eloquent;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $repositories = [
        Repositories\TaskRepository::class => Eloquent\EloquentTaskRepository::class,
        ServiceInterface\FetchTasksServiceInterface::class => Services\FetchTasksService::class,
        ServiceInterface\ManipulateTaskServiceInterface::class => Services\ManipulateTaskService::class,

        Repositories\StatusRepository::class => Eloquent\EloquentStatusRepository::class,
        ServiceInterface\FetchStatusesServiceInterface::class => Services\FetchStatusesService::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}