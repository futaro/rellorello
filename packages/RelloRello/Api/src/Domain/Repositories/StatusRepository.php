<?php

namespace RelloRello\Api\Domain\Repositories;

use RelloRello\Api\Domain\Models\Status;

/**
 * Interface StatusRepository
 *
 * @package RelloRello\Api\Domain\Repositories
 */
interface StatusRepository
{
    /**
     * @param array $p
     * @return Status[]
     */
    public function find(array $p);

    /**
     * @param array $p
     * @return mixed
     */
    public function findAsArray(array $p);
}