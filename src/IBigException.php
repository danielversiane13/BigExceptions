<?php

namespace Danielversiane13\BigExceptions;

use Illuminate\Http\JsonResponse;

interface IBigException
{
    public function getStatusCode(): int;
    public function getErrors(): array;
    public function getMapCode(): int;
    public function render(): JsonResponse;
}
