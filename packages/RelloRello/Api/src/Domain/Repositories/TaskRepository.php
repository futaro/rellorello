<?php

namespace RelloRello\Api\Domain\Repositories;

/**
 * Interface TaskRepository
 *
 * @package RelloRello\Api\Domain\Repositories
 */
interface TaskRepository
{
    public function find(array $p);

    public function findAsArray(array $p);
}