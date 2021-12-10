<?php

namespace Danielversiane13\BigExceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

abstract class AbstractException extends Exception implements IBigException
{
    protected int $statusCode;
    protected array $errors;
    protected int $mapCode;

    public function __construct(string $message, int $statusCode, array $errors = [], int $mapCode = 0)
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
            'message' => $this->message,
            'code' => $this->mapCode,
        ];

        if (count($this->errors)) {
            $jsonResponse['errors'] = $this->errors;
        }

        return response()->json($jsonResponse, $this->statusCode);
    }

    public function report(): void
    {
        if (!$uri = env('TELEMETRY_URI')) {
            return;
        }

        $request = [
            'service' => env('APP_NAME'),
            'message' => $this->message,
            'code' => $this->mapCode,
            'status_code' => $this->statusCode,
            'errors' => $this->errors,
            'request' => request()->all(),
        ];

        Http::withHeaders(['Accept' => 'application/json'])->baseUrl($uri)->post(env('TELEMETRY_URL'), $request);
    }
}
