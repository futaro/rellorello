<?php

namespace RelloRello\Api\Domain\Exceptions;

use Exception;

class NotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        $message = $message . ' not found';

        parent::__construct($message, $code, $previous);
    }


}