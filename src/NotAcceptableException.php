<?php

namespace Danielversiane13\BigExceptions;

class NotAcceptableException extends AbstractException
{
    public function __construct(string $message, array $errors = [], int $map_code = 0)
    {
        parent::__construct($message, 406, $errors, $map_code ?: env('APP_MAP_CODE', 0));
    }
}
