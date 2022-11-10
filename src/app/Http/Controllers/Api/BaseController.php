<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondWithArray(array $array, array $headers = [])
    {
        return new Response($array, $this->statusCode, $headers);
    }

    public function respondWithData(int $code = 200, array $data)
    {
        return $this->setStatusCode($code)->respondWithArray([
            'data' => $data
        ]);
    }

    public function respondWithError(int $code)
    {
        return $this->setStatusCode($code)->respondWithArray([
            'message' => Response::$statusTexts[$code]
        ]);
    }

    protected function successResponse(string $message, array $data = []): Response
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];

        return new Response($response, Response::HTTP_OK);
    }

    protected function errorResponse(string $message = null, string $code): Response
    {
        $response = [
            'status' => false,
            'message' => $message == null ? Response::$statusTexts[$code] : $message
        ];

        return new Response($response, $code);
    }
}
