<?php

namespace RelloRello\Api\Domain\Repositories;

/**
 * Interface StatusRepository
 *
 * @package RelloRello\Api\Domain\Repositories
 */
interface StatusRepository
{
    public function find(array $p);

    public function findAsArray(array $p);
}