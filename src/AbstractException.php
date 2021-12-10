<?php

namespace Danielversiane13\BigExceptions;

use Exception;
use Illuminate\Http\JsonResponse;

abstract class AbstractException extends Exception implements IBigException
{
    public function __construct(string $message, protected int $statusCode, protected array $errors = [], protected int $mapCode = 0)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->mapCode = $mapCode;
        $this->errors = $errors;
    }

    /**
     * Get the value of statusCode.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the value of errors.
     *
     * @return int
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get the value of mapCode.
     *
     * @return int
     */
    public function getMapCode(): int
    {
        return $this->mapCode;
    }

    public function render(): JsonResponse
    {
        $jsonResponse = [
            'message' => $this->getMessage(),
            'code' => $this->getMapCode()
        ];

        if (count($this->getErrors())) {
            $jsonResponse['errors'] = $this->getErrors();
        }

        return response()->json($jsonResponse, $this->getStatusCode());
    }
}
