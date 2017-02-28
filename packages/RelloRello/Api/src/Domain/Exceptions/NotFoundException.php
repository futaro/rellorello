<?php

namespace RelloRello\Api\Domain\Exceptions;

use Exception;

/**
 * Class NotFoundException
 *
 * @package RelloRello\Api\Domain\Exceptions
 */
class NotFoundException extends \Exception
{
    /**
     * NotFoundException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        $message = $message . ' not found';

        parent::__construct($message, $code, $previous);
    }
}