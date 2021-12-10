<?php

namespace Danielversiane13\BigExceptions;

class UnprocessableException extends BigException
{
    public function __construct(string $message, array $errors = [], int $mapCode = 0)
    {
        parent::__construct($message, 422, $errors, $mapCode ?: env('APP_MAP_CODE', 0));
    }
}
