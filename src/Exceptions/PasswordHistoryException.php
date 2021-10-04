<?php

namespace Afiqiqmal\LaraPassPolicy\Exceptions;

use Throwable;

class PasswordHistoryException extends \RuntimeException
{
    public function __construct($message = "", $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}