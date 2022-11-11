<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Response;

class AuthController extends BaseController
{
    public function login(LoginService $loginService)
    {
        $token = $loginService->login();
        if ($token != null) {
            return $this->respondWithData(200, ['token' => $token]);
        }

        return $this->respondWithError(Response::HTTP_UNAUTHORIZED);
    }
}
