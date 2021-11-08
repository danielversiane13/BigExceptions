<?php

namespace Danielversiane13\BigExceptions;

class ForbiddenException extends AbstractException
{
    public function __construct(string $message, array $errors = [], int $map_code = 0)
    {
        parent::__construct($message, 403, $errors, $map_code ?: env('APP_MAP_CODE', 0));
    }
}
