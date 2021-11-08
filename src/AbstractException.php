<?php

namespace Danielversiane13\BigExceptions;

use Exception;
use Illuminate\Http\JsonResponse;

abstract class AbstractException extends Exception implements IBigException
{
    public function __construct(string $message, protected int $status_code, protected array $errors = [], protected int $map_code = 0)
    {
        $this->message = $message;
        $this->status_code = $status_code;
        $this->map_code = $map_code;
        $this->errors = $errors;
    }

    /**
     * Get the value of statusCode.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->status_code;
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
        return $this->map_code;
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
