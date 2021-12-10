<?php

namespace Danielversiane13\BigExceptions;

class NotFoundException extends BigException
{
    public function __construct(string $message, array $errors = [], int $mapCode = 0)
    {
        parent::__construct($message, 404, $errors, $mapCode ?: env('APP_MAP_CODE', 0));
    }
}
