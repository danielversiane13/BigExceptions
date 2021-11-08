<?php

namespace Danielversiane13\BigExceptions;

class UnauthorizedException extends AbstractException
{
    public function __construct(string $message, array $errors = [], int $mapCode = 0)
    {
        parent::__construct($message, 401, $errors, $mapCode ?: env('APP_MAP_CODE', 0));
    }
}
