<?php

namespace App\Exceptions;

class AjaxException extends \Exception
{
    protected $message;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
